<?php

namespace Drupal\maincustomform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user\PrivateTempStoreFactory;
use Drupal\Core\Session\SessionManager;
use Drupal\Core\Session\AccountProxy;
use GuzzleHttp\Client;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Database;
use Drupal\Core\Database\DatabaseExceptionWrapper;
use Drupal\Core\Database\Transaction;



/**
 * Class MultistepFormBase.
 *
 * @package Drupal\maincustomform\Form
 */
abstract class MultistepFormBase extends FormBase  {


  /**
   * GuzzleHttp\Client definition.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;
  /**
   * Drupal\user\PrivateTempStoreFactory definition.
   *
   * @var \Drupal\user\PrivateTempStoreFactory
   */
  protected $userPrivateTempstore;
  /**
   * Drupal\Core\Session\SessionManager definition.
   *
   * @var \Drupal\Core\Session\SessionManager
   */
  protected $sessionManager;
  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * @var \Drupal\user\PrivateTempStore
   */
  protected $store;


  public function __construct(
    Client $http_client,
    PrivateTempStoreFactory $user_private_tempstore,
    SessionManager $session_manager,
    AccountProxy $current_user
  ) {
    $this->httpClient = $http_client;
    $this->userPrivateTempstore = $user_private_tempstore;
    $this->sessionManager = $session_manager;
    $this->currentUser = $current_user;

    $this->store = $this->userPrivateTempstore->get('multistep_data');
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('http_client'),
      $container->get('user.private_tempstore'),
      $container->get('session_manager'),
      $container->get('current_user')
    );
  }


  /**
   * {@inheritdoc}
   */
  //public function getFormId() {
  //  return 'multistep_form_base';
  //}

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->sessionManager->start();
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
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
        drupal_set_message($key . ': ' . $value);
    }

  }

    /**
   * Saves the data from the multistep form.
   */
  protected function saveData() {

   try {

        $db = \Drupal\Core\Database\Database::getConnection();
        $transaction = $db->startTransaction();

        $entity_manager = \Drupal::entityManager();
        $entity_storage_student = $entity_manager->getStorage('student_entity');
        $entity_storage_aitisi = $entity_manager->getStorage('aitisi_entity');

        $student = array(
          'last'=> $this->store->get('last'), 
          'first'=> $this->store->get('first'), 
          'fname'=> $this->store->get('fname'),
          'mname'=> $this->store->get('mname'),
          'idno' => $this->store->get('idno'), 
          'sex' => $this->store->get('sex'),  
          'birthdate' => $this->store->get('birthdate'), 
          'birthplace'=> $this->store->get('birthplace'), 
          'email'=> $this->store->get('email'), 
          'telephone'=> $this->store->get('telephone'), 
          'afm' => $this->store->get('afm'), 
        );
        //save student
        $entity_object = $entity_storage_student->create($student);
        $entity_storage_student->save($entity_object);
        $created_student_id = $entity_object->id();
        

        //get the student id and insert into aitisi entity
        $aitisi = array(
           'prabek'=> $this->store->get('prabek'), 
           'numbek'=> $this->store->get('numbek'), 
           'regno'=> $this->store->get('regno'), 
           'eidikotita_id'=> $this->store->get('eidikotita_select'), 
           'student_id'=> $created_student_id, 
           'iek_id'=> $this->store->get('iek_select'), 
           'region_id'=> $this->store->get('region_select'), 
        );
        

        //save aitisi entity
        $entity_object = $entity_storage_aitisi->create($aitisi);
        $entity_storage_aitisi->save($entity_object);
        $created_aitisi_id = $entity_object->id();
        $this->deleteStore();
        return $created_aitisi_id;
        
        //$response = array(
       // 'return-message' => $created_aitisi_id,
        //);

    }
    catch (\Exception $e) {
      $transaction->rollback();
    }

  }

    /**
   * Helper method that removes all the keys from the store collection used for
   * the multistep form.
   */
  protected function deleteStore() {
    $keys = ['first', 'last', 'fname', 'mname', 'idno', 'sex', 'birth_date', 'birth_place', 'email', 'telephone', 'afm', 'amkauser','prabek', 'numbek', 'regno', 'eidikotita_select', 'iek_select', 'region_select'];
    foreach ($keys as $key) {
      $this->store->delete($key);
    }
   }

}
