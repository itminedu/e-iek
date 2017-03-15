<?php

namespace Drupal\eiek\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Eidikotita entity edit forms.
 *
 * @ingroup eiek
 */
class EidikotitaEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\eiek\Entity\EidikotitaEntity */
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
        drupal_set_message($this->t('Created the %label Eidikotita entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Eidikotita entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.eidikotita_entity.canonical', ['eidikotita_entity' => $entity->id()]);
  }

}
