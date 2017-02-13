<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Epal student iek chosen entities.
 *
 * @ingroup iek
 */
interface EpalStudentEpalChosenInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Epal student iek chosen name.
   *
   * @return string
   *   Name of the Epal student iek chosen.
   */
  public function getName();

  /**
   * Sets the Epal student iek chosen name.
   *
   * @param string $name
   *   The Epal student iek chosen name.
   *
   * @return \Drupal\iek\Entity\EpalStudentEpalChosenInterface
   *   The called Epal student iek chosen entity.
   */
  public function setName($name);

  /**
   * Gets the Epal student iek chosen creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Epal student iek chosen.
   */
  public function getCreatedTime();

  /**
   * Sets the Epal student iek chosen creation timestamp.
   *
   * @param int $timestamp
   *   The Epal student iek chosen creation timestamp.
   *
   * @return \Drupal\iek\Entity\EpalStudentEpalChosenInterface
   *   The called Epal student iek chosen entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Epal student iek chosen published status indicator.
   *
   * Unpublished Epal student iek chosen are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Epal student iek chosen is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Epal student iek chosen.
   *
   * @param bool $published
   *   TRUE to set this Epal student iek chosen to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iek\Entity\EpalStudentEpalChosenInterface
   *   The called Epal student iek chosen entity.
   */
  public function setPublished($published);
  
  //get/set methods for additional fields for  configuration properties.
  public function getStudent_id();
  public function setStudent_id($val);
  public function getEpal_id();
  public function setEpal_id($val);
  public function getChoice_no();
  public function setChoice_no($val);
  public function getPoints_for_order();
  public function setPoints_for_order($val);
  public function getDistance_from_iek();
  public function setDistance_from_iek($val);
  public function getPoints_for_distance();
  public function setPoints_for_distance($val);
  
}
