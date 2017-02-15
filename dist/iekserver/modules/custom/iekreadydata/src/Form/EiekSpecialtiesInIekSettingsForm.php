<?php

namespace Drupal\iekreadydata\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EiekSpecialtiesInEpalSettingsForm.
 *
 * @package Drupal\iekreadydata\Form
 *
 * @ingroup iekreadydata
 */
class EiekSpecialtiesInEpalSettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'EiekSpecialtiesInEpal_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * Defines the settings form for Eiek specialties in iek entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['EiekSpecialtiesInEpal_settings']['#markup'] = 'Settings form for Eiek specialties in iek entities. Manage field settings here.';
    return $form;
  }

}
