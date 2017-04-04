<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Iek users entities.
 *
 * @ingroup iek
 */
interface IekUsersInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Iek users name.
   *
   * @return string
   *   Name of the Iek users.
   */
  public function getName();

  /**
   * Sets the Iek users name.
   *
   * @param string $name
   *   The Iek users name.
   *
   * @return \Drupal\iek\Entity\IekUsersInterface
   *   The called Iek users entity.
   */
  public function setName($name);

  /**
   * Gets the Iek users creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Iek users.
   */
  public function getCreatedTime();

  /**
   * Sets the Iek users creation timestamp.
   *
   * @param int $timestamp
   *   The Iek users creation timestamp.
   *
   * @return \Drupal\iek\Entity\IekUsersInterface
   *   The called Iek users entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Iek users published status indicator.
   *
   * Unpublished Iek users are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Iek users is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Iek users.
   *
   * @param bool $published
   *   TRUE to set this Iek users to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iek\Entity\IekUsersInterface
   *   The called Iek users entity.
   */
  public function setPublished($published);
  
  //get/set methods for additional fields for  configuration properties.
  public function getDrupaluser_id();
  public function setDrupaluser_id($val);
  public function getTaxis_userid();
  public function setTaxis_userid($val);
  public function getTaxis_taxid();
  public function setTaxis_taxid($val);
  public function getSurname();
  public function setSurname($val);
  public function getFathername();
  public function setFathername($val);
  public function getMothername();
  public function setMothername($val);
  //public function getAddress();
  //public function setAddress($val);
  //public function getAddresstk();
  //public function setAddresstk($val);
  //public function getAddressarea();
  //public function setAddressarea($val);
  public function getAccesstoken();
  public function setAccesstoken($val);
  public function getAuthtoken();
  public function setAuthtoken($val);
  public function getTimelogin();
  public function setTimelogin($val);
  public function getTimeregistration();
  public function setTimeregistration($val);
  public function getTimetokeninvalid();
  public function setTimetokeninvalid($val);
  public function getUserip();
  public function setUserip($val);
  

}
