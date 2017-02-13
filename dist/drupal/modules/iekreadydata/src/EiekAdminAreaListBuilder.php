<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Eiek admin area entities.
 *
 * @ingroup iekreadydata
 */
class EiekAdminAreaListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Eiek admin area ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekAdminArea */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.eiek_admin_area.edit_form', array(
          'eiek_admin_area' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
