<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Eiek region entities.
 */
class EiekRegionViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

	/*
    $data['eiek_region']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Eiek region'),
      'help' => $this->t('The Eiek region ID.'),
    );
	*/

    return $data;
  }

}
