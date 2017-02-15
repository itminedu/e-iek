<?php

namespace Drupal\iekreadydata\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Eiek school edit forms.
 *
 * @ingroup iekreadydata
 */
class EiekSchoolForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekSchool */
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
        drupal_set_message($this->t('Created the %label Eiek school.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Eiek school.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.eiek_school.canonical', ['eiek_school' => $entity->id()]);
  }

}
