<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Eiek specialties in iek entities.
 *
 * @ingroup iekreadydata
 */
class EiekSpecialtiesInEpalListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Eiek specialties in iek ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpal */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.eiek_specialties_in_iek.edit_form', array(
          'eiek_specialties_in_iek' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
