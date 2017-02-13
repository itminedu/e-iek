<?php

namespace Drupal\iek\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Epal users entities.
 */
class EpalUsersViewsData extends EntityViewsData {

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
