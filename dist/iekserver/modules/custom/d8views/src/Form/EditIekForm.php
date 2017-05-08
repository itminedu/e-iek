<?php

namespace Drupal\d8views\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Url;

/**
 * Class EditIekForm.
 *
 * @package Drupal\d8views\Form
 */
class EditIekForm extends FormBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  protected $entityManager;

  protected $entityObject;

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
    return 'edit_iek_form';
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

        if ($this->entityObject) {

            $form['#theme'] = 'edit_iek_form';

            //keep the current flagiek value from object
            $currentFlagIek = $this->entityObject->getFlagiek();

            $form['numbek'] = [
              '#type' => 'textfield',
              '#title' => t('Αριθμός ΒΕΚ'),
              '#required' => TRUE,
              '#default_value' => $this->entityObject->getNumbek() ? $this->entityObject->getNumbek() : '',
             '#states' => array(
              'disabled' => array(
                   'input[name="flagiek"]' => array('value' => 1),
                   $currentFlagIek => array('value' => 1),
                  ),
              )
            ];

            $form['prabek'] = [
              '#type' => 'textfield',
              '#title' => t('Πράξη ΒΕΚ'),
              '#required' => TRUE,
              '#default_value' => $this->entityObject->getPrabek() ? $this->entityObject->getPrabek() : '',
               '#states' => array(
               'disabled' => array(
                   'input[name="flagiek"]' => array('value' => 1),
                  ),
              )
            ];

            $form['regno'] = [
              '#type' => 'textfield',
              '#title' => t('ΑΜΚ'),
              '#required' => TRUE,
              '#default_value' => $this->entityObject->getRegno() ? $this->entityObject->getRegno() : '',
               '#states' => array(
              'disabled' => array(
                   'input[name="flagiek"]' => array('value' => 1),
                  ),
              )
            ];

            if(!$this->entityObject->getFlagiek()) {

              $form['flagiek'] = array(
              '#type' => 'radios',
              '#title' => t('Έλεγχος ΙΕΚ'),             
              '#options' => array(0 => t('Αρχική'), 1 => t('Έλεγχος ολοκληρώθηκε')),
              '#default_value' => $this->entityObject->getFlagiek() ? $this->entityObject->getFlagiek() : '',
            );

            }
         


            $form['submit'] = [
                '#type' => 'submit',
                '#value' => $this->t('Submit'),
            ];


  
        }   
        
       // $entity_storage_aitisi->save($entity_object);


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
    //foreach ($form_state->getValues() as $key => $value) {
    //    drupal_set_message($key . ': ' . $value);
    //}

    $this->entityObject->setNumbek($form_state->getValue('numbek'));
    $this->entityObject->setPrabek($form_state->getValue('prabek'));
    $this->entityObject->setRegno($form_state->getValue('regno'));

    //get 
    $initial = $this->entityObject->getFlagiek();
    if(!$initial) {
      $this->entityObject->setFlagiek(1);
        if($this->entityObject->getState() == 'DRAFT') {
         $this->entityObject->setState('PENDING');
      } else if($this->entityObject->getState() == 'PENDING') {
         $this->entityObject->setState('READY');
      } 
    }


    
    $this->entityObject->save();

    $url = Url::fromUserInput('/data/aitiseis/iek');
    $form_state->setRedirectUrl($url);

    /*
      $aitisiArr = $entity_storage_aitisi->loadByProperties(['id' => $aid]);
        $aitisiObj = reset($aitisiArr);
        if ($aitisiObj) {
            $aitisiObj->setNumbek();
            $aitisiObj->setPrabek();
            $aitisiObj->setRegno();
            $aitisiObj->setFlagiek();
            $aitisiObj->save();      
        }  
     */
  }

}
