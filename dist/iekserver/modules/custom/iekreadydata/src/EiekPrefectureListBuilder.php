<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Eiek prefecture entities.
 *
 * @ingroup iekreadydata
 */
class EiekPrefectureListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Eiek prefecture ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekPrefecture */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.eiek_prefecture.edit_form', array(
          'eiek_prefecture' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
