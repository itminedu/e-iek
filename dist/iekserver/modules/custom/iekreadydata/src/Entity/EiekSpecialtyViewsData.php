<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Eiek specialty entities.
 */
class EiekSpecialtyViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

	/*
    $data['eiek_specialty']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Eiek specialty'),
      'help' => $this->t('The Eiek specialty ID.'),
    );
	*/

    return $data;
  }

}
