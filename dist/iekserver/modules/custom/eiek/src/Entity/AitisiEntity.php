<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Aitisi entity entity.
 *
 * @ingroup eiek
 *
 * @ContentEntityType(
 *   id = "aitisi_entity",
 *   label = @Translation("Aitisi entity"),
 *   handlers = {
 *     "storage" = "Drupal\eiek\AitisiEntityStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\eiek\AitisiEntityListBuilder",
 *     "views_data" = "Drupal\eiek\Entity\AitisiEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\eiek\Form\AitisiEntityForm",
 *       "add" = "Drupal\eiek\Form\AitisiEntityForm",
 *       "edit" = "Drupal\eiek\Form\AitisiEntityForm",
 *       "delete" = "Drupal\eiek\Form\AitisiEntityDeleteForm",
 *     },
 *     "access" = "Drupal\eiek\AitisiEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\eiek\AitisiEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "aitisi_entity",
 *   revision_table = "aitisi_entity_revision",
 *   revision_data_table = "aitisi_entity_field_revision",
 *   admin_permission = "administer aitisi entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "id",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/aitisi_entity/{aitisi_entity}",
 *     "add-form" = "/admin/structure/aitisi_entity/add",
 *     "edit-form" = "/admin/structure/aitisi_entity/{aitisi_entity}/edit",
 *     "delete-form" = "/admin/structure/aitisi_entity/{aitisi_entity}/delete",
 *     "version-history" = "/admin/structure/aitisi_entity/{aitisi_entity}/revisions",
 *     "revision" = "/admin/structure/aitisi_entity/{aitisi_entity}/revisions/{aitisi_entity_revision}/view",
 *     "revision_delete" = "/admin/structure/aitisi_entity/{aitisi_entity}/revisions/{aitisi_entity_revision}/delete",
 *     "collection" = "/admin/structure/aitisi_entity",
 *   },
 *   field_ui_base_route = "aitisi_entity.settings"
 * )
 */
class AitisiEntity extends RevisionableContentEntityBase implements AitisiEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }

    // If no revision author has been set explicitly, make the aitisi_entity owner the
    // revision author.
    if (!$this->getRevisionUser()) {
      $this->setRevisionUserId($this->getOwnerId());
    }
  }



  public function getSchool() {
    return $this->get('iek_id')->entity;
  }

  public function getSchoolId() {
    return $this->get('iek_id')->value;
  }

  public function setSchoolId($studentId) {
    $this->set('iek_id', $studentId);
    return $this;
  }


  public function getStudent() {
    return $this->get('student_id')->entity;
  }

  public function getStudentId() {
    return $this->get('student_id')->value;
  }

  public function setStudentId($student_id) {
    $this->set('student_id', $student_id);
    return $this;
  }

  public function getEidikotita() {
    return $this->get('eidikotita_id')->entity;
  }

  public function getEidikotitaId() {
    return $this->get('eidikotita_id')->value;
  }

  public function setEidikotitaId($eidikotita_id) {
    $this->set('eidikotita_id', $eidikotita_id);
    return $this;
  }

  public function getPrabek() {
    return $this->get('prabek')->value;
  }

  public function setPrabek($prabek) {
    $this->set('prabek', $prabek);
    return $this;
  }

  public function getNumbek() {
    return $this->get('numbek')->value;
  }

  public function setNumbek($numbek) {
    $this->set('numbek', $numbek);
    return $this;
  }

  public function getRegno() {
    return $this->get('regno')->value;
  }

  public function setRegno($regno) {
    $this->set('regno', $regno);
    return $this;
  }

  public function getRegion() {
    return $this->get('region_id')->entity;
  }

  public function getRegionId() {
    return $this->get('region_id')->value;
  }

  public function setRegionId($region_id) {
    $this->set('region_id', $region_id);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function getState() {
    return $this->get('state')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setState($state) {
    $this->set('state', $state);
    return $this;
  }


    /**
   * {@inheritdoc}
   */
  public function getFlagiek() {
    return $this->get('flagiek')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setFlagiek($flagiek) {
    $this->set('flagiek', $flagiek);
    return $this;
  }

      /**
   * {@inheritdoc}
   */
  public function getFlagbank() {
    return $this->get('flagbank')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setFlagbank($flagbank) {
    $this->set('flagbank', $flagbank);
    return $this;
  }


      /**
   * {@inheritdoc}
   */
  public function getPedio() {
    return $this->get('pedio')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPedio($pedio) {
    $this->set('pedio', $pedio);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRevisionCreationTime() {
    return $this->get('revision_timestamp')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRevisionCreationTime($timestamp) {
    $this->set('revision_timestamp', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRevisionUser() {
    return $this->get('revision_uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function setRevisionUserId($uid) {
    $this->set('revision_uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Aitisi entity entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['student_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Σπουδαστής'))
      ->setDescription(t('Στοιχεία αποφοίτου'))
      ->setRequired(TRUE)
      ->setSetting('target_type', 'student_entity')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

      $fields['eidikotita_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Ειδικότητα'))
      ->setDescription(t('Ειδικότητα'))
      ->setRequired(TRUE)
      ->setSetting('target_type', 'eidikotita_entity')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

     $fields['prabek'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Πράξη ΒΕΚ'))
      ->setDescription(t('Πράξη ΒΕΚ'))
      ->setRequired(TRUE)
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

      $fields['iek_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ΙΕΚ αποφοίτησης'))
      ->setDescription(t('ΙΕΚ αποφοίτησης'))
      ->setRequired(TRUE)
      ->setSetting('target_type', 'school_entity')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

      $fields['numbek'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Αριθμός ΒΕΚ'))
      ->setDescription(t('Αριθμός ΒΕΚ'))
      ->setRequired(TRUE)
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

     $fields['regno'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Αριθμός Μητρωου Καταρτιζομένου ΙΕΚ'))
      ->setDescription(t('Αριθμός Μητρώου Καταρτιζομένου'))
      ->setRequired(TRUE)
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

      $fields['region_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Επιθυμητός τόπος εξέτασης'))
      ->setDescription(t('Επιθυμητός τόπος εξέτασης'))
      ->setSetting('target_type', 'region_entity')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


      $fields['pedio'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Πεδίο ενδιαφέροντος'))
      ->setDescription(t('Πεδίο ενδιαφέροντος'))
      ->setRequired(TRUE)
      ->setSettings(array(
         'max_length' => 16,
         'default_value' => 'Draft',
         'allowed_values' => array(
            'practical' => t('Πρακτικό'),
            'theoretical' => t('Θεωρητικό'),
            'both' => t('Και τα δύο'),
            ),
        ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
     ->setDisplayOptions('form', array(
        'type' => 'options_select',
        'weight' => -17,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

     $fields['state'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Κατάσταση Αίτησης'))
      ->setDescription(t('Κατάσταση Αίτησης'))
      ->setRequired(TRUE)
      ->setSettings(array(
         'max_length' => 16,
         'default_value' => 'Draft',
         'allowed_values' => array(
            'Draft' => 'Draft',
            'Pending' => 'Pending',
            'Ready' => 'Ready',
            ),
        ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
     ->setDisplayOptions('form', array(
        'type' => 'options_select',
        'weight' => -17,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['flagiek'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Έλεγχος υπεύθυνου ΙΕΚ'))
      ->setDefaultValue(FALSE)
      ->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'settings' => array(
          'display_label' => TRUE,
        ),
        'weight' => -18,
      ))
      ->setDisplayConfigurable('form', TRUE);

    $fields['flagbank'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Έλεγχος υπεύθυνου τράπεζας'))
      ->setDefaultValue(FALSE)
      ->setDisplayOptions('form', array(
        'type' => 'boolean_checkbox',
        'settings' => array(
          'display_label' => TRUE,
        ),
        'weight' => -18,
      ))
      ->setDisplayConfigurable('form', TRUE);


    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Aitisi entity is published.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['revision_timestamp'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Revision timestamp'))
      ->setDescription(t('The time that the current revision was created.'))
      ->setQueryable(FALSE)
      ->setRevisionable(TRUE);

    $fields['revision_uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Revision user ID'))
      ->setDescription(t('The user ID of the author of the current revision.'))
      ->setSetting('target_type', 'user')
      ->setQueryable(FALSE)
      ->setRevisionable(TRUE);

    $fields['revision_translation_affected'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Revision translation affected'))
      ->setDescription(t('Indicates if the last edit of a translation belongs to current revision.'))
      ->setReadOnly(TRUE)
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE);

    return $fields;
  }

}
