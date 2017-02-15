<?php

namespace Drupal\iek;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of IEK Student entities.
 *
 * @ingroup iek
 */
class EpalStudentListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
	$header['iekuser_id'] = $this->t('ID ???????????? ????????');
    $header['name'] = $this->t('??????????');
    $header['studentsurname'] = $this->t('??????????????');
    //$header['guardianfirstname'] = $this->t('?????????? ????????????????');
	//$header['guardiansurname'] = $this->t('?????????????? ????????????????');
    $header['studentamka'] = $this->t('AMKA ????????????');
  
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iek\Entity\EpalStudent */
    $row['id'] = $entity->id();
	
	$row['iekuser_id'] = $this->l(
      $entity->getEpaluser_id(),
      new Url(
        'entity.iek_student.edit_form', array(
          'iek_student' => $entity->id(),
        )
      )
    );
    
    $row['name'] = $this->l(
      $entity->getName(),
      new Url(
        'entity.iek_student.edit_form', array(
          'iek_student' => $entity->id(),
        )
      )
    );

    $row['studentsurname'] = $this->l(
      $entity->getStudentSurname(),
      new Url(
        'entity.iek_student.edit_form', array(
          'iek_student' => $entity->id(),
        )
      )
    );

	/*
    $row['guardianfirstname'] = $this->l(
      $entity->getGuardianFirstname(),
      new Url(
        'entity.iek_student.edit_form', array(
          'iek_student' => $entity->id(),
        )
      )
    );
	
	$row['guardiansurname'] = $this->l(
      $entity->getGuardianSurname(),
      new Url(
        'entity.iek_student.edit_form', array(
          'iek_student' => $entity->id(),
        )
      )
    );
	*/

   $row['studentAmka'] = $this->l(
      $entity->getStudentAmka(),
      new Url(
        'entity.iek_student.edit_form', array(
          'iek_student' => $entity->id(),
        )
      )
    );

    return $row + parent::buildRow($entity);
  }

}
