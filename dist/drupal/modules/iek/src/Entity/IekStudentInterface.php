<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining IEK Student entities.
 *
 * @ingroup iek
 */
interface EpalStudentInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the IEK Student name.
   *
   * @return string
   *   Name of the IEK Student.
   */
  public function getName();

  /**
   * Sets the IEK Student name.
   *
   * @param string $name
   *   The IEK Student name.
   *
   * @return \Drupal\iek\Entity\EpalStudentInterface
   *   The called IEK Student entity.
   */
  public function setName($name);

  /**
   * Gets the IEK Student creation timestamp.
   *
   * @return int
   *   Creation timestamp of the IEK Student.
   */
  public function getCreatedTime();

  /**
   * Sets the IEK Student creation timestamp.
   *
   * @param int $timestamp
   *   The IEK Student creation timestamp.
   *
   * @return \Drupal\iek\Entity\EpalStudentInterface
   *   The called IEK Student entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the IEK Student published status indicator.
   *
   * Unpublished IEK Student are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the IEK Student is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a IEK Student.
   *
   * @param bool $published
   *   TRUE to set this IEK Student to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iek\Entity\EpalStudentInterface
   *   The called IEK Student entity.
   */
  public function setPublished($published);

  //get/set methods for additional fields for  configuration properties.
  public function getUser_id();
  public function setUser_id($val);
  public function getEpaluser_id();
  public function setEpaluser_id($val);
  public function getStudentSurname();
  public function setStudentSurname($val);
  //public function getGuardianFirstname();
  //public function setGuardianFirstname($val);
  //public function getGuardianSurname();
  //public function setGuardianSurname($val);
  public function getStudentAmka();
  public function setStudentAmka($val);
  public function getRegionAddress();
  public function setRegionAddress($val);
  public function getRegionTK();
  public function setRegionTK($val);
  public function getRegionArea();
  public function setRegionArea($val);
  public function getCertificateType();
  public function setCertificateType($val);
  public function getCurrentclass();
  public function setCurrentclass($val);
  public function getCurrentiek();
  public function setCurrentiek($val);
  public function getCurrentsector();
  public function setCurrentsector($val);
  public function getTelnum();
  public function setTelnum($val);
  public function getRelationToStudent();
  public function setRelationToStudent($val);
  
}
