<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Eiek school entities.
 *
 * @ingroup iekreadydata
 */
class EiekSchoolListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Eiek school ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekSchool */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.eiek_school.edit_form', array(
          'eiek_school' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
