<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Eiek specialties in iek entities.
 */
class EiekSpecialtiesInEpalViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

	/*
    $data['eiek_specialties_in_iek']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Eiek specialties in iek'),
      'help' => $this->t('The Eiek specialties in iek ID.'),
    );
	*/

    return $data;
  }

}
