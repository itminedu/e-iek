<?php

namespace Drupal\iek\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for IEK Student Class edit forms.
 *
 * @ingroup iek
 */
class EpalStudentClassForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\iek\Entity\EpalStudentClass */
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
        drupal_set_message($this->t('Created the %label IEK Student Class.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label IEK Student Class.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.iek_student_class.canonical', ['iek_student_class' => $entity->id()]);
  }

}
