<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eidikotita entity entities.
 *
 * @ingroup eiek
 */
interface EidikotitaEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Eidikotita entity name.
   *
   * @return string
   *   Name of the Eidikotita entity.
   */
  public function getName();

  /**
   * Sets the Eidikotita entity name.
   *
   * @param string $name
   *   The Eidikotita entity name.
   *
   * @return \Drupal\eiek\Entity\EidikotitaEntityInterface
   *   The called Eidikotita entity entity.
   */
  public function setName($name);

  /**
   * {@inheritdoc}
   */
  public function getEidcode();

  /**
   * {@inheritdoc}
   */
  public function setEidcode($eidcode);
  /**
   * Gets the Eidikotita entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Eidikotita entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Eidikotita entity creation timestamp.
   *
   * @param int $timestamp
   *   The Eidikotita entity creation timestamp.
   *
   * @return \Drupal\eiek\Entity\EidikotitaEntityInterface
   *   The called Eidikotita entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Eidikotita entity published status indicator.
   *
   * Unpublished Eidikotita entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Eidikotita entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Eidikotita entity.
   *
   * @param bool $published
   *   TRUE to set this Eidikotita entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\eiek\Entity\EidikotitaEntityInterface
   *   The called Eidikotita entity entity.
   */
  public function setPublished($published);

}
