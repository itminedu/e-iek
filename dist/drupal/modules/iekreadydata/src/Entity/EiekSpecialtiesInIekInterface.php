<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek specialties in iek entities.
 *
 * @ingroup iekreadydata
 */
interface EiekSpecialtiesInEpalInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek specialties in iek name.
   *
   * @return string
   *   Name of the Eiek specialties in iek.
   */
  public function getName();

  /**
   * Sets the Eiek specialties in iek name.
   *
   * @param string $name
   *   The Eiek specialties in iek name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpalInterface
   *   The called Eiek specialties in iek entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek specialties in iek creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek specialties in iek.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek specialties in iek creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek specialties in iek creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpalInterface
   *   The called Eiek specialties in iek entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek specialties in iek published status indicator.
   *
   * Unpublished Eiek specialties in iek are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek specialties in iek is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek specialties in iek.
   *
   * @param bool $published
   *   TRUE to set this Eiek specialties in iek to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpalInterface
   *   The called Eiek specialties in iek entity.
   */
  public function setPublished($published);

}
