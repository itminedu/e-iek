<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Eidikotita entity entities.
 *
 * @ingroup eiek
 */
interface EidikotitaEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

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

  /**
   * Gets the Eidikotita entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Eidikotita entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\eiek\Entity\EidikotitaEntityInterface
   *   The called Eidikotita entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Eidikotita entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Eidikotita entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\eiek\Entity\EidikotitaEntityInterface
   *   The called Eidikotita entity entity.
   */
  public function setRevisionUserId($uid);

}
