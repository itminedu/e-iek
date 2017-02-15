<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek prefecture entities.
 *
 * @ingroup iekreadydata
 */
interface EiekPrefectureInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek prefecture name.
   *
   * @return string
   *   Name of the Eiek prefecture.
   */
  public function getName();

  /**
   * Sets the Eiek prefecture name.
   *
   * @param string $name
   *   The Eiek prefecture name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekPrefectureInterface
   *   The called Eiek prefecture entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek prefecture creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek prefecture.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek prefecture creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek prefecture creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekPrefectureInterface
   *   The called Eiek prefecture entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek prefecture published status indicator.
   *
   * Unpublished Eiek prefecture are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek prefecture is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek prefecture.
   *
   * @param bool $published
   *   TRUE to set this Eiek prefecture to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekPrefectureInterface
   *   The called Eiek prefecture entity.
   */
  public function setPublished($published);

}
