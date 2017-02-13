<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek admin area entities.
 *
 * @ingroup iekreadydata
 */
interface EiekAdminAreaInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek admin area name.
   *
   * @return string
   *   Name of the Eiek admin area.
   */
  public function getName();

  /**
   * Sets the Eiek admin area name.
   *
   * @param string $name
   *   The Eiek admin area name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekAdminAreaInterface
   *   The called Eiek admin area entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek admin area creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek admin area.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek admin area creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek admin area creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekAdminAreaInterface
   *   The called Eiek admin area entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek admin area published status indicator.
   *
   * Unpublished Eiek admin area are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek admin area is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek admin area.
   *
   * @param bool $published
   *   TRUE to set this Eiek admin area to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekAdminAreaInterface
   *   The called Eiek admin area entity.
   */
  public function setPublished($published);

}
