<?php

namespace Drupal\eiek\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for School entity entities.
 */
class SchoolEntityViewsData extends EntityViewsData {

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
