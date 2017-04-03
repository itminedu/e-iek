<?php

namespace Drupal\encrypt\Tests;

/**
 * Tests the encrypt admin UI and encryption / decryption service.
 *
 * @group encrypt
 */
class EncryptTest extends EncryptTestBase {

  /**
   * Test adding an encryption profile and encrypting / decrypting with it.
   */
  public function testEncryptAndDecrypt() {
    // Create an encryption profile config entity.
    $this->drupalGet('admin/config/system/encryption/profiles/add');

    // Check if the plugin exists.
    $this->assertOption('edit-encryption-method', 'test_encryption_method', t('Encryption method option is present.'));
    $this->assertText('Test Encryption method', t('Encryption method text is present'));

    $edit = [
      'encryption_method' => 'test_encryption_method',
    ];
    $this->drupalPostAjaxForm(NULL, $edit, 'encryption_method');

    $edit = [
      'id' => 'test_encryption_profile',
      'label' => 'Test encryption profile',
      'encryption_method' => 'test_encryption_method',
      'encryption_key' => $this->testKeys['testing_key_128']->id(),
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));

    $encryption_profile = \Drupal::service('entity.manager')->getStorage('encryption_profile')->load('test_encryption_profile');
    $this->assertTrue($encryption_profile, 'Encryption profile was succesfully saved.');

    // Test the encryption service with our encryption profile.
    $test_string = 'testing 123 &*#';
    $enc_string = \Drupal::service('encryption')->encrypt($test_string, $encryption_profile);
    $this->assertEqual($enc_string, 'zhfgorfvkgrraovggrfgvat 123 &*#', 'The encryption service is not properly processing');

    // Test the decryption service with our encryption profile.
    $dec_string = \Drupal::service('encryption')->decrypt($enc_string, $encryption_profile);
    $this->assertEqual($dec_string, $test_string, 'The decryption service is not properly processing');
  }

  /**
   * Tests validation of encryption profiles.
   */
  public function testProfileValidation() {
    // Create an encryption profile config entity.
    $this->drupalGet('admin/config/system/encryption/profiles/add');

    // Check if the plugin exists.
    $this->assertOption('edit-encryption-method', 'test_encryption_method', t('Encryption method option is present.'));
    $this->assertText('Test Encryption method', t('Encryption method text is present'));

    $edit = [
      'encryption_method' => 'test_encryption_method',
    ];
    $this->drupalPostAjaxForm(NULL, $edit, 'encryption_method');

    $edit = [
      'id' => 'test_encryption_profile',
      'label' => 'Test encryption profile',
      'encryption_method' => 'test_encryption_method',
      'encryption_key' => $this->testKeys['testing_key_128']->id(),
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));

    // Now delete the testkey.
    $this->testKeys['testing_key_128']->delete();

    // Check if the error message is shown.
    $this->drupalGet('admin/config/system/encryption/profiles');
    $this->assertText('The key linked to this encryption profile does not exist.');

    // Test "check_profile_status" setting.
    $this->config('encrypt.settings')
      ->set('check_profile_status', FALSE)
      ->save();
    $this->drupalGet('admin/config/system/encryption/profiles');
    $this->assertNoText('The key linked to this encryption profile does not exist.');

    // Test the encryption profile edit form.
    $this->drupalGet('admin/config/system/encryption/profiles/manage/test_encryption_profile');
    $this->assertFieldByName('confirm_edit', NULL, 'Edit confirmation checkbox found');
    $enc_method_disabled = $this->xpath('//select[@name="encryption_method" and @disabled="disabled"]');
    $this->assertTrue(count($enc_method_disabled) === 1, 'The encryption method select is disabled.');
    $enc_key_disabled = $this->xpath('//select[@name="encryption_key" and @disabled="disabled"]');
    $this->assertTrue(count($enc_key_disabled) === 1, 'The encryption key select is disabled.');

    // Check the edit confirmation checkbox.
    $edit = [
      'confirm_edit' => 1,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertNoFieldByName('confirm_edit', NULL, 'Confirmation checkbox is gone.');
    $enc_method_disabled = $this->xpath('//select[@name="encryption_method" and @disabled="disabled"]');
    $this->assertTrue(count($enc_method_disabled) === 0, 'The encryption method select is no longer disabled.');
    $enc_key_disabled = $this->xpath('//select[@name="encryption_key" and @disabled="disabled"]');
    $this->assertTrue(count($enc_key_disabled) === 0, 'The encryption key select is no longer disabled.');
  }

  /**
   * Test Encryption profile entity with encryption method plugin config forms.
   */
  public function testEncryptionMethodConfig() {
    // Create an encryption profile config entity.
    $this->drupalGet('admin/config/system/encryption/profiles/add');

    // Check if the plugin exists.
    $this->assertOption('edit-encryption-method', 'config_test_encryption_method', t('Config encryption method option is present'));
    $this->assertText('Config Test Encryption method', t('Config encryption method text is present'));

    // Check encryption method without config.
    $edit = [
      'encryption_method' => 'test_encryption_method',
    ];
    $this->drupalPostAjaxForm(NULL, $edit, 'encryption_method');
    $this->assertNoFieldByName('encryption_method_configuration[mode]', NULL, 'Test encryption method has no config form');

    // Check encryption method with config.
    $edit = [
      'encryption_method' => 'config_test_encryption_method',
    ];
    $this->drupalPostAjaxForm(NULL, $edit, 'encryption_method');
    $this->assertFieldByName('encryption_method_configuration[mode]', NULL, 'Config test encryption method has config form');
    $this->assertOptionWithDrupalSelector('edit-encryption-method-configuration-mode', 'CBC', 'Config form shows element');

    // Save encryption profile with configured encryption method.
    $edit = [
      'id' => 'test_config_encryption_profile',
      'label' => 'Test encryption profile',
      'encryption_method' => 'config_test_encryption_method',
      'encryption_method_configuration[mode]' => 'CFB',
      'encryption_key' => $this->testKeys['testing_key_128']->id(),
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));

    // Check if encryption method configuration was succesfully saved.
    $encryption_profile = \Drupal::service('entity.manager')->getStorage('encryption_profile')->load('test_config_encryption_profile');
    $this->assertTrue($encryption_profile, 'Encryption profile was succesfully saved');
    $encryption_method = $encryption_profile->getEncryptionMethod();
    $encryption_method_config = $encryption_method->getConfiguration();
    $this->assertEqual(['mode' => 'CFB'], $encryption_method_config, 'Encryption method config correctly saved');

    // Change the encryption method to a non-config one.
    $this->drupalGet('admin/config/system/encryption/profiles/manage/test_config_encryption_profile');

    // First, confirm we want to edit the encryption profile.
    $edit = [
      'confirm_edit' => 1,
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));

    // Select encryption method without config.
    $edit = [
      'encryption_method' => 'test_encryption_method',
    ];
    $this->drupalPostAjaxForm(NULL, $edit, 'encryption_method');
    $this->assertNoFieldByName('encryption_method_configuration[mode]', NULL, 'Test encryption method has no config form');

    // Save encryption profile with simple encryption method.
    $edit = [
      'encryption_method' => 'test_encryption_method',
      'encryption_key' => $this->testKeys['testing_key_128']->id(),
    ];
    $this->drupalPostForm(NULL, $edit, t('Save'));

    // Check if encryption method configuration was succesfully updated.
    $encryption_profile = \Drupal::service('entity.manager')->getStorage('encryption_profile')->load('test_config_encryption_profile');
    $this->assertTrue($encryption_profile, 'Encryption profile was succesfully loaded');
    $encryption_method = $encryption_profile->getEncryptionMethod();
    $encryption_method_config = $encryption_method->getConfiguration();
    $this->assertEqual([], $encryption_method_config, 'Encryption method config correctly saved');
  }

}
