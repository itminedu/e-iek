<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek specialty entities.
 *
 * @ingroup iekreadydata
 */
interface EiekSpecialtyInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek specialty name.
   *
   * @return string
   *   Name of the Eiek specialty.
   */
  public function getName();

  /**
   * Sets the Eiek specialty name.
   *
   * @param string $name
   *   The Eiek specialty name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSpecialtyInterface
   *   The called Eiek specialty entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek specialty creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek specialty.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek specialty creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek specialty creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSpecialtyInterface
   *   The called Eiek specialty entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek specialty published status indicator.
   *
   * Unpublished Eiek specialty are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek specialty is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek specialty.
   *
   * @param bool $published
   *   TRUE to set this Eiek specialty to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSpecialtyInterface
   *   The called Eiek specialty entity.
   */
  public function setPublished($published);

}
