<?php

namespace Drupal\iek\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Epal student course field edit forms.
 *
 * @ingroup iek
 */
class EpalStudentCourseFieldForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\iek\Entity\EpalStudentCourseField */
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
        drupal_set_message($this->t('Created the %label Epal student course field.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Epal student course field.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.iek_student_course_field.canonical', ['iek_student_course_field' => $entity->id()]);
  }

}
