<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eiek sectors entities.
 *
 * @ingroup iekreadydata
 */
interface EiekSectorsInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eiek sectors name.
   *
   * @return string
   *   Name of the Eiek sectors.
   */
  public function getName();

  /**
   * Sets the Eiek sectors name.
   *
   * @param string $name
   *   The Eiek sectors name.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSectorsInterface
   *   The called Eiek sectors entity.
   */
  public function setName($name);

  /**
   * Gets the Eiek sectors creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eiek sectors.
   */
  public function getCreatedTime();

  /**
   * Sets the Eiek sectors creation timestamp.
   *
   * @param int $timestamp
   *   The Eiek sectors creation timestamp.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSectorsInterface
   *   The called Eiek sectors entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eiek sectors published status indicator.
   *
   * Unpublished Eiek sectors are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eiek sectors is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eiek sectors.
   *
   * @param bool $published
   *   TRUE to set this Eiek sectors to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iekreadydata\Entity\EiekSectorsInterface
   *   The called Eiek sectors entity.
   */
  public function setPublished($published);

}
