<?php

namespace Drupal\iek;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Epal student course field entities.
 *
 * @ingroup iek
 */
class EpalStudentCourseFieldListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('??????????');
    $header['student_id'] = $this->t('ID ????????????');
    $header['courseField_id'] = $this->t('ID ??????????????????????');        
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iek\Entity\EpalStudentCourseField */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.iek_student_course_field.edit_form', array(
          'iek_student_course_field' => $entity->id(),
        )
      )
    );
    $row['student_id'] = $this->l(
      $entity->getStudent_id(),
      new Url(
        'entity.iek_student_course_field.edit_form', array(
          'iek_student_course_field' => $entity->id(),
        )
      )
    );
    $row['courseField_id'] = $this->l(
      $entity->getCourseField_id(),
      new Url(
        'entity.iek_student_course_field.edit_form', array(
          'iek_student_course_field' => $entity->id(),
        )
      )
    );





    return $row + parent::buildRow($entity);
  }

}
