<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Student entity entities.
 *
 * @ingroup eiek
 */
class StudentEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Student entity ID');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\eiek\Entity\StudentEntity */
    $row['id'] = $entity->id();
  /*  $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.student_entity.edit_form', array(
          'student_entity' => $entity->id(),
        )
      )
    ); */
    return $row + parent::buildRow($entity);
  }

}
