<?php

namespace Drupal\iekreadydata\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Eiek specialties in iek edit forms.
 *
 * @ingroup iekreadydata
 */
class EiekSpecialtiesInEpalForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpal */
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
        drupal_set_message($this->t('Created the %label Eiek specialties in iek.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Eiek specialties in iek.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.eiek_specialties_in_iek.canonical', ['eiek_specialties_in_iek' => $entity->id()]);
  }

}
