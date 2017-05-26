<?php

namespace Drupal\d8views\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Url;


/**
 * Class EditEoppepForm.
 *
 * @package Drupal\d8views\Form
 */
class EditEoppepForm extends FormBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  protected $entityManager;

  protected $entityObject;

  protected $studentObject;

  public function __construct(
    EntityManager $entity_manager
  ) {
    $this->entityManager = $entity_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'edit_eoppep_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $aid = NULL) {

  if(isset($aid)) {
        $entity_manager = \Drupal::entityManager();
      
        $entity_storage_aitisi = $entity_manager->getStorage('aitisi_entity');


        
        $aitisiArr = $entity_storage_aitisi->loadByProperties(['id' => $aid]);
        $this->entityObject = reset($aitisiArr);

        //get the student entity 
        $this->studentObject = $this->entityObject->getStudent();

        if ($this->entityObject) {

            $form['#theme'] = 'edit_eoppep_form';
            

            $form['numbek'] = [
              '#type' => 'textfield',
              '#title' => t('Αριθμός ΒΕΚ'),
              '#default_value' => $this->entityObject->getNumbek() ? $this->entityObject->getNumbek() : '',
                '#states' => array(
                'disabled' => array(
                'input[name="numbek"]' => array('filled' => TRUE),
                ),
                ),
            ];

            $form['prabek'] = [
              '#type' => 'textfield',
              '#title' => t('Πράξη ΒΕΚ'),
              '#default_value' => $this->entityObject->getPrabek() ? $this->entityObject->getPrabek() : '',
              '#states' => array(
                'disabled' => array(
                'input[name="prabek"]' => array('filled' => TRUE),
                ),
                ),
            ];

            $form['regno'] = [
              '#type' => 'textfield',
              '#title' => t('ΑΜΚ'),
              '#default_value' => $this->entityObject->getRegno() ? $this->entityObject->getRegno() : '',
               '#states' => array(
                'disabled' => array(
                'input[name="regno"]' => array('filled' => TRUE),
                ),
                ),
            ];
         
            $form['flagiek'] = array(
              '#type' => 'radios',
              '#title' => t('Έλεγχος ΙΕΚ'),        
              '#options' => array(0 => t('Αρχική'), 1 => t('Έλεγχος ολοκληρώθηκε')),
              '#default_value' => $this->entityObject->getFlagiek() ? $this->entityObject->getFlagiek() : '',
            );
            

             if(!$this->entityObject->getFlagbank()) {
              $form['flagbank'] = array(
              '#type' => 'radios',
              '#title' => t('Έλεγχος Τράπεζας'),        
              '#options' => array(0 => t('Αρχική'), 1 => t('Έλεγχος ολοκληρώθηκε')),
              '#default_value' => $this->entityObject->getFlagbank() ? $this->entityObject->getFlagbank() : '',
              );
             }

             $form['last'] = array(
              '#type' => 'textfield',
              '#title' => t('Επιθετο'),
              '#size' => 60,
              '#maxlength' => 120,
              '#required' => TRUE,
              '#default_value' => $this->studentObject->getLast() ? $this->studentObject->getLast():'',
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
              '#default_value' => $this->studentObject->getFirst() ? $this->studentObject->getFirst():'',
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
              '#default_value' => $this->studentObject->getFname() ? $this->studentObject->getFname():'',
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
              '#default_value' => $this->studentObject->getMname() ? $this->studentObject->getMname():'',
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
              '#default_value' => $this->studentObject->getIdno() ? $this->studentObject->getIdno():'',
              '#states' => array(
              'disabled' => array(
              'input[name="idno"]' => array('filled' => TRUE),
              ),
              ),
            );

            $form['sex'] = array(
              '#type' => 'radios',
              '#title' => t('Φυλο'),
              //'#default_value' => $studentObject->getSex() ? $studentObject->getSex():'',
              '#default_value' => 1,
              '#options' => array(0 => t('Άνδρας'), 1 => t('Γυναίκα')),
              '#states' => array(
              'disabled' => array(
              'input[name="sex"]' => array('filled' => TRUE),
              ),
              ),
            );

            $form['birth_date'] = array(
              '#type' => 'date',
              '#title' => t('Ημερομηνία Γέννησης'),
              '#default_value' => $this->studentObject->getBirthdate() ? $this->studentObject->getBirthdate():'',
              '#states' => array(
              'disabled' => array(
              'input[name="birth_date"]' => array('filled' => TRUE),
              ),
              //'#default_value' => array('year' => 2020, 'month' => 2, 'day' => 15,)
              // '#default_value' => '2016-01-27'
              ),
            );

            $form['birth_place'] = array(
              '#type' => 'textfield',
              '#title' => t('Τοποθεσία Γέννησης'),
              '#size' => 60,
              '#maxlength' => 120,
              '#required' => TRUE,
              '#default_value' => $this->studentObject->getBirthplace() ? $this->studentObject->getBirthplace():'',
              '#states' => array(
              'disabled' => array(
              'input[name="birth_place"]' => array('filled' => TRUE),
              ),
              ),
            );

            $form['email'] = array(
              '#type' => 'email',
              '#title' => t('Email'),
              '#default_value' => $this->studentObject->getEmail() ? $this->studentObject->getEmail():'',
            );

            $form['telephone'] = array(
              '#type' => 'tel',
              '#title' => t('Τηλέφωνο'),
              '#default_value' => $this->studentObject->getTelephone() ? $this->studentObject->getTelephone():'',
            );

            $form['afm'] = array(
              '#type' => 'textfield',
              '#title' => t('ΑΦΜ'),
              '#size' => 30,
              '#maxlength' => 30,
              '#required' => TRUE,
              '#default_value' => $this->studentObject->getAfm() ? $this->studentObject->getAfm():'',
              '#states' => array(
              'disabled' => array(
              'input[name="afm"]' => array('filled' => TRUE),
              ),
              ),
            );


            $form['submit'] = [
                '#type' => 'submit',
                '#value' => $this->t('Submit'),
            ];
            

            $form['delete_aitisi'] = [
                '#title' => $this->t('Delete'),
                '#type' => 'link',
                '#attributes' => array('class' => array('button')),
                '#url' => Url::fromRoute('d8views.aitiseis_controller_deleteAitisi',array('aid' => $aid)),
            ];


  
        }   
      


    }


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


    //save telephone and email update the check for bank to true
    $this->studentObject->setTelephone($form_state->getValue('telephone'));
    $this->studentObject->setEmail($form_state->getValue('email'));

    //check the initial check bank value
    $initial = $this->entityObject->getFlagbank();
    if(!$initial) {
       $this->entityObject->setFlagbank(1);
       //change the current STATE
      if($this->entityObject->getState() == 'DRAFT') {
      $this->entityObject->setState('PENDING');
      } else if($this->entityObject->getState() == 'PENDING') {
      $this->entityObject->setState('READY');
      } 
    }
    
    $this->studentObject->save();
    $this->entityObject->save();

    $url = Url::fromUserInput('/data/aitiseis/eoppep');
    $form_state->setRedirectUrl($url);

  }

}
