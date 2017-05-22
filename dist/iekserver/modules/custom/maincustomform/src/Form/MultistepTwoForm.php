<?php

namespace Drupal\maincustomform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Ajax;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\ReplaceCommand;


/**
 * Class MultistepTwoForm.
 *
 * @package Drupal\maincustomform\Form
 */
class MultistepTwoForm extends MultistepFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_two_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
     
     $form = parent::buildForm($form, $form_state);

     $form['#theme'] = 'my_second_form';

     $form['last'] = array(
      '#type' => 'textfield',
      '#title' => t('Επιθετο'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('last') ? $this->store->get('last') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="last"]' => array('filled' => TRUE),
      ),
    ),
    );

    $form['first'] = array(
      '#type' => 'textfield',
      '#title' => t('Όνομα'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('first') ? $this->store->get('first') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="first"]' => array('filled' => TRUE),
      ),
      ),
    );

    $form['fname'] = array(
      '#type' => 'textfield',
      '#title' => t('Όνομα πατέρα'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('fname') ? $this->store->get('fname') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="fname"]' => array('filled' => TRUE),
      ),
      ),
    );

    $form['mname'] = array(
      '#type' => 'textfield',
      '#title' => t('Όνομα μητέρας'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('mname') ? $this->store->get('mname') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="mname"]' => array('filled' => TRUE),
      ),
       ),
    );

    $form['idno'] = array(
      '#type' => 'textfield',
      '#title' => t('Αριθμός ταυτότητας'),
      '#size' => 8,
      '#maxlength' => 25,
      '#required' => TRUE,
      '#default_value' => $this->store->get('idno') ? $this->store->get('idno') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="idno"]' => array('filled' => TRUE),
      ),
      ),
    );

    $form['sex'] = array(
    '#type' => 'radios',
    '#title' => t('Φυλο'),
    '#default_value' => $this->store->get('sex') ? $this->store->get('sex') : '',
    '#options' => array(0 => t('Άνδρας'), 1 => t('Γυναίκα')),
    '#states' => array(
    'disabled' => array(
        'input[name="sex"]' => array('filled' => TRUE),
      ),
     ),
    );

    $form['birthdate'] = array(
    '#type' => 'date',
    '#title' => t('Ημερομηνία Γέννησης'),
    '#default_value' => $this->store->get('birthdate') ? $this->store->get('birthdate') : '',
    '#states' => array(
    'disabled' => array(
        'input[name="birthdate"]' => array('filled' => TRUE),
      ),
     //'#default_value' => array('year' => 2020, 'month' => 2, 'day' => 15,)
   // '#default_value' => '2016-01-27'
    ),
    );

    $form['birthplace'] = array(
      '#type' => 'textfield',
      '#title' => t('Τοποθεσία Γέννησης'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('birthplace') ? $this->store->get('birthplace') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="birthplace"]' => array('filled' => TRUE),
      ),
      ),
    );

    $form['email'] = array(
    '#type' => 'email',
    '#title' => t('Email'),
    '#required' => TRUE,
    '#default_value' => $this->store->get('email') ? $this->store->get('email') : '',
    );


    $form['sendemailcode'] = [
      '#type' => 'button',
       '#type' => 'button',
       '#value' => 'Αποστολή κωδικού',
      '#ajax' => array(
        'callback' => '::respondToAjax',
         'event' => 'click',
        'progress' => array(
         'type' => 'throbber',
        'message' => 'Send code',
        ),
     ),
       '#states' => array(
      'enabled' => array(
        'input[name="email"]' => array('filled' => TRUE),
      ),
      ),
    ];



    $form['emailcode'] = array(
      '#type' => 'textfield',
      '#title' => t('Κωδικός εγκυρότητας email'),
      '#size' => 60,
      '#maxlength' => 80,
      '#required' => TRUE,
      '#default_value' => $this->store->get('emailcode') ? $this->store->get('emailcode') : '',
    );


    $form['telephone'] = array(
    '#type' => 'tel',
    '#title' => t('Τηλέφωνο'),
    '#default_value' => $this->store->get('telephone') ? $this->store->get('telephone') : '',
    );

    $form['afm'] = array(
      '#type' => 'textfield',
      '#title' => t('ΑΦΜ'),
      '#size' => 30,
      '#maxlength' => 30,
      '#required' => TRUE,
      '#default_value' => $this->store->get('afm') ? $this->store->get('afm') : '',
      '#states' => array(
      'disabled' => array(
        'input[name="afm"]' => array('filled' => TRUE),
      ),
       ),
    );

/*
     $form['actions']['previous'] = array(
      '#type' => 'link',
     //'#value' => $this->t('Προηγούμενο'),
      '#title' => $this->t('Προηγούμενο'),
      '#attributes' => array(
        'class' => array('button'),
      ),
      '#weight' => 0,
      '#url' => Url::fromRoute('maincustomform.multistep_one_form'),
    );*/

    $form['actions']['next'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#value' => $this->t('Επομενο'),
      // Custom submission handler for page 1.
      //'#submit' => ['::fapiExampleMultistepFormNextSubmit'],
      // Custom validation handler for page 1.
      //'#validate' => ['::fapiExampleMultistepFormNextValidate'],
    ];

    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
   // parent::validateForm($form, $form_state);

    if($form_state->getValue('emailcode') == '') {
      $form_state->setErrorByName('emailcode', t('Υποχρεωτικός κωδικός ταυτοποίησης'));

      return;
    }

    if(!($this->verifyCode($form_state->getValue('emailcode')))) {
      $form_state->setErrorByName('emailcode', t('Κωδικός ταυτοποίησης λανθασμένος'));
      return;
    }

    

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    //foreach ($form_state->getValues() as $key => $value) {
     //  drupal_set_message($key . ': ' . $value);
    //}
    //save values to store
    $this->store->set('first', $form_state->getValue('first'));
    $this->store->set('last', $form_state->getValue('last'));
    $this->store->set('fname', $form_state->getValue('fname'));
    $this->store->set('mname', $form_state->getValue('mname'));
    $this->store->set('idno', $form_state->getValue('idno'));
    $this->store->set('sex', $form_state->getValue('sex'));
    $this->store->set('birthdate', $form_state->getValue('birthdate'));
    $this->store->set('birthplace', $form_state->getValue('birthplace'));
    $this->store->set('email', $form_state->getValue('email'));
    $this->store->set('telephone', $form_state->getValue('telephone'));
    $this->store->set('afm', $form_state->getValue('afm'));
  
    $form_state->setRedirect('maincustomform.multistep_three_form');

   }


  


      public function respondToAjax(array &$form, FormStateInterface $form_state) {
      // Instantiate an AjaxResponse Object to return.
      $ajax_response = new AjaxResponse();
      
      //...........
      $this->sendCodeVerification($form_state);
      // Add a command to execute on form, jQuery .html() replaces content between tags.
      // In this case, we replace the desription with wheter the username was found or not.
      //$ajax_response->addCommand(new HtmlCommand('#edit-telephone', 'hahaha'));
      
      // CssCommand did not work.
      //$ajax_response->addCommand(new CssCommand('#edit-user-name--description', array('color', $color)));
      
      // Add a command, InvokeCommand, which allows for custom jQuery commands.
      // In this case, we alter the color of the description.
      //$ajax_response->addCommand(new InvokeCommand('#edit-telephone', 'css', array('color', 'red')));

     
      $ajax_response->addCommand(new ReplaceCommand(
       '#edit-sendemailcode',
      '<p><strong>Ο κωδικός στάλθηκε</strong></p>'));
      //$ajax_response = [
      //'#markup' => '<div>Saved</div>',
      //];
      // ValCommand does not exist, so we can use InvokeCommand.
      //$ajax_response->addCommand(new InvokeCommand('#edit-telephone', 'val' , array('test1')));
      
      // Return the AjaxResponse Object.
      return $ajax_response;
      }




}
