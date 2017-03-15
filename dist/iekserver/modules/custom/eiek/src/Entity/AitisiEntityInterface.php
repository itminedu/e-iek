<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Aitisi entity entities.
 *
 * @ingroup eiek
 */
interface AitisiEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.


  public function getStudent_id();
  public function setStudent_id($student_id);

  public function getEidikotita_id();
  public function setEidikotita_id($eidikotita_id);

  public function getPrabek();
  public function setPrabek($prabek);

  public function getNumbek();
  public function setNumbek($numbek);

  public function getRegno();
  public function setRegno($regno);

  public function getRegion_id();
  public function setRegion_id($region_id);

  /**
   * Gets the Aitisi entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Aitisi entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Aitisi entity creation timestamp.
   *
   * @param int $timestamp
   *   The Aitisi entity creation timestamp.
   *
   * @return \Drupal\eiek\Entity\AitisiEntityInterface
   *   The called Aitisi entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Aitisi entity published status indicator.
   *
   * Unpublished Aitisi entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Aitisi entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Aitisi entity.
   *
   * @param bool $published
   *   TRUE to set this Aitisi entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\eiek\Entity\AitisiEntityInterface
   *   The called Aitisi entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Aitisi entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Aitisi entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\eiek\Entity\AitisiEntityInterface
   *   The called Aitisi entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Aitisi entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Aitisi entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\eiek\Entity\AitisiEntityInterface
   *   The called Aitisi entity entity.
   */
  public function setRevisionUserId($uid);

}
