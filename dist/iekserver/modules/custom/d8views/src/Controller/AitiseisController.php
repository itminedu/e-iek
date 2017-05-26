<?php

namespace Drupal\d8views\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Database;
use Drupal\Core\Database\DatabaseExceptionWrapper;
use Drupal\Core\Database\Transaction;

/**
 * Class AitiseisController.
 *
 * @package Drupal\d8views\Controller
 */
class AitiseisController extends ControllerBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  protected $entityManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityManager $entity_manager) {
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')
    );
  }

  /**
   * Deleteaitisi.
   *
   * @return string
   *   Return Hello string.
   */
  public function deleteAitisi($aid) {

     //get aitisi by id
     $entity_storage_aitisi = $this->entityManager->getStorage('aitisi_entity');
     $entity_storage_student = $this->entityManager->getStorage('student_entity');
     $entity_storage_iek_users = $this->entityManager->getStorage('iek_users');


     $aitisiArr = $entity_storage_aitisi->loadByProperties(['id' => $aid]);



    try {

        $db = \Drupal\Core\Database\Database::getConnection();
        $transaction = $db->startTransaction();


     //if aitisi exists
     if($aitisiArr) {
       $aitisiObj = reset($aitisiArr);
       //find the drupal user id
       $drupalUserId = $aitisiObj->getOwnerId();
       //get Student object
       $studentObj = $aitisiObj->getStudent();
       //find the student id 
       $studentId = $studentObj->id();
       //delete iek user
       $iekUsersArr = $entity_storage_iek_users->loadByProperties(['user_id' => $drupalUserId]);
       $iekUserObj = reset($iekUsersArr);
       if($iekUserObj) {
         //DELETE ONLY REQUESTS THAT HAVE BEEN CREATED USING TAXIS SERVICE NOT DEMO REQUESTS OR ADMIN REQUESTS
         $entity_storage_aitisi->delete($aitisiArr);
         $iekUserId = $iekUserObj->id();
         //delete student
         $entity_storage_student->delete(array($studentId => $studentObj));
         $entity_storage_iek_users->delete(array($iekUserId => $iekUserObj));
         user_delete($drupalUserId);
         //$url = Url::fromRoute('d8views.edit_eoppep_form',array('aid' => $aid));
         $url = Url::fromUserInput('/data/aitiseis/eoppep');
         $path = $url->toString();
         return new RedirectResponse($path);
       } else {
            return [
             '#type' => 'markup',
             '#markup' => $this->t('Δεν είναι δυνατή η διαγραφή αίτησης που δεν έχει εισαχθεί μέσω taxis'),
           ];
       }


     }

    }
    catch (\Exception $e) {
      $transaction->rollback();
    }
     
    //return [
    //  '#type' => 'markup',
    //  '#markup' => $this->t('Delete aitisi with id: $aid'.$studentId),
    //];
  }

}
