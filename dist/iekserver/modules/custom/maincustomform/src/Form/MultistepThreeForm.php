<?php

namespace Drupal\maincustomform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class MultistepThreeForm.
 *
 * @package Drupal\maincustomform\Form
 */
class MultistepThreeForm extends MultistepFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_three_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    $form['#theme'] = 'my_third_form';

    $form['description'] = [
      '#type' => 'item',
      '#title' => $this->t('A basic multistep form (page 2)'),
    ];

    $form['prabek'] = [
      '#type' => 'textfield',
      '#title' => t('Πράξη ΒΕΚ'),
      '#required' => TRUE,
      '#default_value' => $this->store->get('prabek') ? $this->store->get('prabek') : '',
    ];

    $form['numbek'] = [
      '#type' => 'textfield',
      '#title' => t('Αριθμός ΒΕΚ'),
      '#required' => TRUE,
      '#default_value' => $this->store->get('numbek') ? $this->store->get('numbek') : '',
    ];

    $form['regno'] = [
      '#type' => 'textfield',
      '#title' => t('ΑΜΚ'),
      '#required' => TRUE,
      '#default_value' => $this->store->get('regno') ? $this->store->get('regno') : '',
    ];

    $form['eidikotita_select'] = array(
    '#type' => 'select',
    '#title' => 'Ειδικότητα',
    '#options' => $eidikotita_options,

    );

    $form['region_select'] = array(
    '#type' => 'select',
    '#title' => 'Επιθυμητή περιοχή εξέτασης',
    '#options' => $region_options,
    );

    $form['iek_select'] = array(
    '#type' => 'select',
    '#title' => 'ΙΕΚ προέλευσης',
    '#options' => $iek_options,
    );

    /*$form['#attached']['drupalSettings']['previousFormValues'] = array(
      'first' => $this->store->get('first'),
      'last' => $this->store->get('last'),
      'fname' => $this->store->get('fname'),
      'mname' => $this->store->get('mname'),
      'idno' => $this->store->get('idno'),
      'birth_date' => $this->store->get('birth_date'),
      'birth_place' => $this->store->get('birth_place'),
      'email' => $this->store->get('email'),
      'telephone' => $this->store->get('telephone'),
      'afm' => $this->store->get('afm'),
      'sex' => $this->store->get('sex'),
    );
    */
    $form['back'] = array(
      '#type' => 'link',
      '#title' => $this->t('Προηγούμενο'),
      '#attributes' => array(
        'class' => array('button'),
      ),
      '#weight' => 0,
      '#url' => Url::fromRoute('maincustomform.multistep_two_form'),
    );

    $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
   // parent::validateForm($form, $form_state);
    $this->store->set('prabek', $form_state->getValue('prabek'));
    $this->store->set('numbek', $form_state->getValue('numbek'));
    $this->store->set('regno', $form_state->getValue('regno'));
    $this->store->set('eidikotita_select', $form_state->getValue('eidikotita_select'));
    $this->store->set('iek_select', $form_state->getValue('iek_select'));
    $this->store->set('region_select', $form_state->getValue('region_select'));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {


    $returnedId = parent::saveData();

    $url = Url::fromUserInput('/aitisi/'.$returnedId);
    $form_state->setRedirectUrl($url);


  }

}
