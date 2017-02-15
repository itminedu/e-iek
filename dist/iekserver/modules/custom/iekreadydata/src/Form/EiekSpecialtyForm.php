<?php

namespace Drupal\iekreadydata\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Eiek specialty edit forms.
 *
 * @ingroup iekreadydata
 */
class EiekSpecialtyForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekSpecialty */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Eiek specialty.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Eiek specialty.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.eiek_specialty.canonical', ['eiek_specialty' => $entity->id()]);
  }

}
