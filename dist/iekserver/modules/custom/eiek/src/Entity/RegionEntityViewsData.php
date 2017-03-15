<?php

namespace Drupal\eiek\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Region entity entities.
 */
class RegionEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
