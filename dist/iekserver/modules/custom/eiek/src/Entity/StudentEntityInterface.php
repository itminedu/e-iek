<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Student entity entities.
 *
 * @ingroup eiek
 */
interface StudentEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.


  public function getFirst();
  public function setFirst($first);

  public function getLast();
  public function setLast($last);

  public function getFname();
  public function setFname($fname);

  public function getMname();
  public function setMname($mname);

  public function getIdno();

  public function setIdno($idno);

  public function getSex();

  public function setSex($sex);

  public function getBirthdate();

  public function setBirthdate($birthdate);

  public function getBirthplace();

  public function setBirthplace($birthplace);

  public function getEmail();

  public function setEmail($email);

  public function getTelephone();

  public function setTelephone($telephone);

  public function getAfm();

  public function setAfm($afm);


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

}
