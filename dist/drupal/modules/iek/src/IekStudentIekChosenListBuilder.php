<?php

namespace Drupal\iek;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Epal student iek chosen entities.
 *
 * @ingroup iek
 */
class EpalStudentEpalChosenListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('??????????');
	$header['student_id'] = $this->t('Id ????????????');
	$header['iek_id'] = $this->t('????????');
	$header['choice_no'] = $this->t('?????????? ????????????????????');
	 
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iek\Entity\EpalStudentEpalChosen */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.iek_student_iek_chosen.edit_form', array(
          'iek_student_iek_chosen' => $entity->id(),
        )
      )
    );
	//$entity->get('name')->getString();
	$row['student_id'] = $entity->getStudent_id();
	$row['iek_id'] = $entity->getEpal_id();
	$row['choice_no'] = $entity->getChoice_no();
	
    return $row + parent::buildRow($entity);
  }

}
