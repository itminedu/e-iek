<?php

namespace Drupal\maincustomform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\encrypt\Entity\EncryptionProfile;
use GuzzleHttp\Client;
/**
 * Class MultistepOneForm.
 *
 * @package Drupal\maincustomform\Form
 */
class MultistepOneForm extends MultistepFormBase {

  //private $key;

  //private $encprofile;
  /**
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_one_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

   $form = parent::buildForm($form, $form_state);

   $form['#theme'] = 'my_first_form';

   $form['amkauser'] = array(
      '#type' => 'textfield',
      '#title' => t('ΑΜΚΑ'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('amkauser') ? $this->store->get('amkauser') : '',
    );

   $form['last'] = array(
      '#type' => 'textfield',
      '#title' => t('Επιθετο'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
      '#default_value' => $this->store->get('last') ? $this->store->get('last') : '',
    );


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
  } //build form

  /**
    * {@inheritdoc}
    */

  public function validateForm(array &$form, FormStateInterface $form_state) {
   parent::validateForm($form, $form_state);


    if (strlen($form_state->getValue('amkauser')) != 11 ) {
       $form_state->setErrorByName('amkauser', t('Ο αριθμός ΑΜΚΑ πρέπει να έχει 11 ψηφία'));
       return;
    }

    /*
    $this->encprofile = EncryptionProfile::load('wso2_profile');
    $this->key = \Drupal::service('encryption')->decrypt(\Drupal::service('key.repository')->getKey('wso2_encrypted')->getKeyValue(), $this->encprofile);
    //return;

    //-----------------check validity of AMKA------------------------------------------// 
    //----------------------------------------------------------------------------------//
    $checked_amka = $form_state->getValue('amkauser');

    $url ='https://wso2.minedu.gov.gr/amka/v1.3/'.$checked_amka;

    $this->httpClient = new Client(['verify' => false ]);
    
    try {
      $res_amka_checker = $this->httpClient->get($url, array('headers' => array('Authorization' => $this->key)));
    }
    catch(\Exception $e) {
       $form_state->setErrorByName('amkauser', t('Αδυναμία σύνδεσης με την υπηρεσία ταυτοποίησης'));
    }

    if(!is_null($res_amka_checker) && $res_amka_checker->getStatusCode() == 200) {
       $check_result_amka = $res_amka_checker->getBody();
       if($check_result_amka == 'false') {
           $form_state->setErrorByName('amkauser', t('Ο αριθμός ΑΜΚΑ δεν είναι έγκυρος'));
        } else if ($check_result_amka == 'true') {
          //successful validation continue process
          //second call to validate the pair amka epitheto
          $last = $form_state->getValue('last');

          //call extended version of WSO2
          $url2 ='https://wso2.minedu.gov.gr/amka/v1.3/'.$checked_amka.'/'.$last.'?fields=match,surname_cur_gr,name_gr,father_gr,mother_gr,sex,birth_date,birth_municipality,id_num,tid';
       
          $this->httpClient = new Client(['verify' => false ]);
          $result_second_checker = $this->httpClient->get($url2, array('headers' => 
            array('Authorization' => $this->key),
            )); 
          if(!is_null($result_second_checker) && $result_second_checker->getStatusCode() == 200) {

             // $contents = $result_second_checker->getBody();
              $contents = (string) $result_second_checker->getBody();
              $arrValues = explode(',', $contents);

              $birth_date = $arrValues[6];
              $sex = $arrValues[5];
              if(isset($birth_date)) {
                $arr_date = explode('/', $birth_date);
                list($d, $m, $y) = $arr_date;              
                $birth_date = $y.'-'.$m.'-'.$d;
              }
               if(isset($sex)) {
                $sex = ($sex == 'ΑΡΡΕΝ'?0:1);
               }
             // drupal_set_message('test'.var_dump($contents));
            //  $form_state->setErrorByName('amkauser', t('Σφάλμα ελέγχου ΑΜ'.$contents));
              //$obj_json =json_decode($contents);   

              if($arrValues[0] == 'true') {
                  $this->store->set('amkauser', $checked_amka);
                  $this->store->set('first', $arrValues[2]);
                  $this->store->set('last', $arrValues[1]);
                  $this->store->set('fname', $arrValues[3]);
                  $this->store->set('mname', $arrValues[4]);
                  $this->store->set('idno', $arrValues[8]);
                  $this->store->set('sex', $sex);
                  $this->store->set('birth_date', $birth_date );
                  $this->store->set('birth_place', $arrValues[7]);
                  $this->store->set('afm', substr($arrValues[9],2,9));
              } else {
                  $form_state->setErrorByName('amkauser', t('Σφάλμα ελέγχου ΑΜΚΑ και Επιθέτου'));
              }

          } else {
             $form_state->setErrorByName('amkauser', t('Σφάλμα ελέγχου ΑΜΚΑ και Επιθέτου'));
          }
          /*
          $url2 ='https://wso2.minedu.gov.gr/amka/v1.3/'.$checked_amka.'/'.$last.'/extended';
          $this->httpClient = new Client(['verify' => false ]);
          $result_second_checker = $this->httpClient->get($url2, array('headers' => array('Authorization' => $this->key))); 
          if(!is_null($result_second_checker) && $result_second_checker->getStatusCode() == 200) {
              $contents = $result_second_checker->getBody()->getContents();
              $obj_json =json_decode($contents);
              $birth_date = $obj_json->birth_date;
              $sex = $obj_json->sex;
              if(isset($birth_date)) {
                $arr_date = explode('/', $birth_date);
                list($d, $m, $y) = $arr_date;              
                $birth_date = $y.'-'.$m.'-'.$d;
              }
               if(isset($sex)) {
                $sex = ($sex == 'ΑΡΡΕΝ'?0:1);
               }

              if($obj_json->match == 'true') {
                  $this->store->set('amkauser', $checked_amka);
                  $this->store->set('first', $obj_json->name_gr);
                  $this->store->set('last', $obj_json->surname_cur_gr);
                  $this->store->set('fname', $obj_json->father_gr);
                  $this->store->set('mname', $obj_json->mother_gr);
                  $this->store->set('idno', $obj_json->id_num);
                  $this->store->set('sex', $sex);
                  $this->store->set('birth_date', $birth_date );
                  $this->store->set('birth_place', $obj_json->birth_municipality);
                  $this->store->set('afm', substr($obj_json->tid,2,9));
              } else {
                  $form_state->setErrorByName('amkauser', t('Σφάλμα ελέγχου ΑΜΚΑ και Επιθέτου'));
              }

          } else {
             $form_state->setErrorByName('amkauser', t('Σφάλμα ελέγχου ΑΜΚΑ και Επιθέτου'));
          }*/


 //       }
 //    } else {
 //          $form_state->setErrorByName('amkauser', t('Σφάλμα ελέγχου ΑΜΚΑ και Επιθέτου'));
 //   }

      
      $this->store->set('amkauser', '26127500260');
      $this->store->set('first', 'ΑΧΙΛΛΕΑΣ');
      $this->store->set('last', 'ΚΑΤΣΑΡΟΣ');
      $this->store->set('fname', 'ΓΕΩΡΓΙΟΣ');
      $this->store->set('mname', 'ΕΥΓΕΝΙΑ');
      $this->store->set('idno', 'ΧΧ455676');
      $this->store->set('sex', 1);
      $this->store->set('birthdate', '1976-12-10' );
      $this->store->set('birthplace', 'ΑΘΗΝΑ');
      $this->store->set('afm', '057339456');
   
  }//validation end

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect('maincustomform.multistep_two_form');
  }//submitForm end


}
