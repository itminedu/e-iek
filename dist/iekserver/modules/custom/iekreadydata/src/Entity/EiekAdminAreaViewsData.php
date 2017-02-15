<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Eiek admin area entities.
 */
class EiekAdminAreaViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

  /*
   $data['eiek_admin_area']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Eiek admin area'),
      'help' => $this->t('The Eiek admin area ID.'),
    );
*/
    return $data;
  }

}
