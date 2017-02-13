<?php

namespace Drupal\iek\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for IEK Student entities.
 */
class EpalStudentViewsData extends EntityViewsData {

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
