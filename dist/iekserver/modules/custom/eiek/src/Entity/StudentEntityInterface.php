<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Student entity entities.
 *
 * @ingroup eiek
 */
interface StudentEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Student entity name.
   *
   * @return string
   *   Name of the Student entity.
   */
  //public function getName();

  /**
   * Sets the Student entity name.
   *
   * @param string $name
   *   The Student entity name.
   *
   * @return \Drupal\eiek\Entity\StudentEntityInterface
   *   The called Student entity entity.
   */
  //public function setName($name);



  public function getFirst();
  public function setFirst($first);

  public function getLast();
  public function setLast($last);

  public function getFname();
  public function setFname($fname);

  public function getMname();
  public function setMname($mname);

  /**
   * Gets the Student entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Student entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Student entity creation timestamp.
   *
   * @param int $timestamp
   *   The Student entity creation timestamp.
   *
   * @return \Drupal\eiek\Entity\StudentEntityInterface
   *   The called Student entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Student entity published status indicator.
   *
   * Unpublished Student entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Student entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Student entity.
   *
   * @param bool $published
   *   TRUE to set this Student entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\eiek\Entity\StudentEntityInterface
   *   The called Student entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Student entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Student entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\eiek\Entity\StudentEntityInterface
   *   The called Student entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Student entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Student entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\eiek\Entity\StudentEntityInterface
   *   The called Student entity entity.
   */
  public function setRevisionUserId($uid);

}
