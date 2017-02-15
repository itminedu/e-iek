<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek school entities.
 *
 * @ingroup iekreadydata
 */
interface EiekSchoolInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek school name.
   *
   * @return string
   *   Name of the Eiek school.
   */
  public function getName();

  /**
   * Sets the Eiek school name.
   *
   * @param string $name
   *   The Eiek school name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSchoolInterface
   *   The called Eiek school entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek school creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek school.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek school creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek school creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSchoolInterface
   *   The called Eiek school entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek school published status indicator.
   *
   * Unpublished Eiek school are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek school is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek school.
   *
   * @param bool $published
   *   TRUE to set this Eiek school to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSchoolInterface
   *   The called Eiek school entity.
   */
  public function setPublished($published);

}
