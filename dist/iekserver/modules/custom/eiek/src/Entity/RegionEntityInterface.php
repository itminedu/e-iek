<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Region entity entities.
 *
 * @ingroup eiek
 */
interface RegionEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Region entity name.
   *
   * @return string
   *   Name of the Region entity.
   */
  public function getName();

  /**
   * Sets the Region entity name.
   *
   * @param string $name
   *   The Region entity name.
   *
   * @return \Drupal\eiek\Entity\RegionEntityInterface
   *   The called Region entity entity.
   */
  public function setName($name);

  /**
   * Gets the Region entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Region entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Region entity creation timestamp.
   *
   * @param int $timestamp
   *   The Region entity creation timestamp.
   *
   * @return \Drupal\eiek\Entity\RegionEntityInterface
   *   The called Region entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Region entity published status indicator.
   *
   * Unpublished Region entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Region entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Region entity.
   *
   * @param bool $published
   *   TRUE to set this Region entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\eiek\Entity\RegionEntityInterface
   *   The called Region entity entity.
   */
  public function setPublished($published);

}
