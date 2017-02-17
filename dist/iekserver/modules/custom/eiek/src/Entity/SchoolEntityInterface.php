<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining School entity entities.
 *
 * @ingroup eiek
 */
interface SchoolEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the School entity name.
   *
   * @return string
   *   Name of the School entity.
   */
  public function getName();

  /**
   * Sets the School entity name.
   *
   * @param string $name
   *   The School entity name.
   *
   * @return \Drupal\eiek\Entity\SchoolEntityInterface
   *   The called School entity entity.
   */
  public function setName($name);

  /**
   * Gets the School entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the School entity.
   */
  public function getCreatedTime();

  /**
   * Sets the School entity creation timestamp.
   *
   * @param int $timestamp
   *   The School entity creation timestamp.
   *
   * @return \Drupal\eiek\Entity\SchoolEntityInterface
   *   The called School entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the School entity published status indicator.
   *
   * Unpublished School entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the School entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a School entity.
   *
   * @param bool $published
   *   TRUE to set this School entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\eiek\Entity\SchoolEntityInterface
   *   The called School entity entity.
   */
  public function setPublished($published);

}
