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
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;


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

  protected $entityTypeManager;

  protected $connection;

  protected $logger;


  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    Connection $connection,
    Client $http_client,
    PrivateTempStoreFactory $user_private_tempstore,
    SessionManager $session_manager,
    AccountProxy $current_user,
    LoggerChannelFactoryInterface $loggerChannel
  ) {
    $this->entityTypeManager = $entityTypeManager;
    $this->connection = $connection;
    $this->httpClient = $http_client;
    $this->userPrivateTempstore = $user_private_tempstore;
    $this->sessionManager = $session_manager;
    $this->currentUser = $current_user;
    $this->logger = $loggerChannel->get('maincustomform');


    $this->store = $this->userPrivateTempstore->get('multistep_data');
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('database'),
      $container->get('http_client'),
      $container->get('user.private_tempstore'),
      $container->get('session_manager'),
      $container->get('current_user'),
       $container->get('logger.factory')
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
        //save state
        $aitisi = array(
           'prabek'=> $this->store->get('prabek'), 
           'numbek'=> $this->store->get('numbek'), 
           'regno'=> $this->store->get('regno'), 
           'eidikotita_id'=> $this->store->get('eidikotita_select'), 
           'student_id'=> $created_student_id, 
           'iek_id'=> $this->store->get('iek_select'), 
           'region_id'=> $this->store->get('region_select'), 
           'pedio' => $this->store->get('pedio'),
           'state' => 'DRAFT'
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


       //-----------------------send verification code ------------------------//
    protected function sendCodeVerification(FormStateInterface $form_state)
    {
        //if the user logged in using taxis 
        $authToken =  \Drupal::service('session')->get('authtoken');
      
        $trx = $this->connection->startTransaction();
        try {

        if(is_null($authToken)) {
          //user logged in through normal drupal process
          //get drupal current user
         //$verificationCode = uniqid();
          $verificationCode = '591e077f05d16';
          $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
          $user->set('mail', $form_state->getValue('email'));
         // $user->setEmail($form_state->getValue('email'));
          $user->save();
          $this->sendEmailWithCode($form_state->getValue('email'), $verificationCode, $user);
          return true;
        } else {
          //user logged in using taxis

        $ieklUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $ieklUser = reset($ieklUsers);


        if ($ieklUser) {
            //get drupal user from iek user
            $user = $this->entityTypeManager->getStorage('user')->load($ieklUser->user_id->target_id);
            if ($user) {
    
                    $verificationCode = uniqid();
                    $ieklUser->set('verificationcode', $verificationCode);
                    $ieklUser->set('verificationcodeverified', FALSE);
                    $ieklUser->save();
                    $user->set('mail', $form_state->getValue('email'));
                    $user->save();
                    $this->sendEmailWithCode($form_state->getValue('email'), $verificationCode, $user);
                    return true;
            }
            else {
                    return false;
            } 

          } else {
                 return false;

        } 

        } 
      
        } catch (\Exception $ee) {
            $this->logger->warning($ee->getMessage());
            $trx->rollback();
            return false;
        }
        return true;

    }


    private function sendEmailWithCode($email, $vc, $user) {
        $mailManager = \Drupal::service('plugin.manager.mail');

        $module = 'maincustomform';
        $key = 'send_verification_code';
        $to = $email;
        $params['message'] = 'verification code=' . $vc;
        $langcode = $user->getPreferredLangcode();
        $send = true;

        $mail_sent = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

        if ($mail_sent) {
            $this->logger->info("Mail Sent successfully!!!");
        }
        else {
            $this->logger->info("There is error in sending mail.");
        }
        return;
    }

    protected function verifyCode($verificationCode)
    {

        //if the user logged in using taxis 
        $authToken =  \Drupal::service('session')->get('authtoken');


        if(is_null($authToken)) {
         //user is admin not logged in using taxis
         if ($verificationCode == '591e077f05d16') {
            return true;
         }
        } else {
         
        $eiekUsers = $this->entityTypeManager->getStorage('iek_users')->loadByProperties(array('authtoken' => $authToken));
        $eiekUser = reset($eiekUsers);
        if ($eiekUser) {

            $user = $this->entityTypeManager->getStorage('user')->load($eiekUser->user_id->target_id);
            if ($user) {
  
              if ($eiekUser->verificationcode->value !== $verificationCode) {
                        $eiekUser->set('verificationcodeverified', false);
                        $eiekUser->save();
                        return false;
                    } else {
                        $eiekUser->set('verificationcodeverified', true);
                        $eiekUser->save();
                        return true;
                }

            } else {
                 return false;
            }

        } else {
            return false;
        }
        }

    }

   
}
