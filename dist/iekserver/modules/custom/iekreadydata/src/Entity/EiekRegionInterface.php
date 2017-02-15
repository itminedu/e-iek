<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek region entities.
 *
 * @ingroup iekreadydata
 */
interface EiekRegionInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek region name.
   *
   * @return string
   *   Name of the Eiek region.
   */
  public function getName();

  /**
   * Sets the Eiek region name.
   *
   * @param string $name
   *   The Eiek region name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekRegionInterface
   *   The called Eiek region entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek region creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek region.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek region creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek region creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekRegionInterface
   *   The called Eiek region entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek region published status indicator.
   *
   * Unpublished Eiek region are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek region is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek region.
   *
   * @param bool $published
   *   TRUE to set this Eiek region to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekRegionInterface
   *   The called Eiek region entity.
   */
  public function setPublished($published);

}
