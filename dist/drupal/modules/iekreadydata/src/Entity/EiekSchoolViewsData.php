<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Eiek school entities.
 */
class EiekSchoolViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

	/*
    $data['eiek_school']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Eiek school'),
      'help' => $this->t('The Eiek school ID.'),
    );
	*/

    return $data;
  }

}
