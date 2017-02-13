<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Eiek prefecture entities.
 */
class EiekPrefectureViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

	/*
    $data['eiek_prefecture']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Eiek prefecture'),
      'help' => $this->t('The Eiek prefecture ID.'),
    );
	*/

    return $data;
  }

}
