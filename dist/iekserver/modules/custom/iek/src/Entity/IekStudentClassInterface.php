<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining IEK Student Class entities.
 *
 * @ingroup iek
 */
interface EpalStudentClassInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the IEK Student Class name.
   *
   * @return string
   *   Name of the IEK Student Class.
   */
  public function getName();

  /**
   * Sets the IEK Student Class name.
   *
   * @param string $name
   *   The IEK Student Class name.
   *
   * @return \Drupal\iek\Entity\EpalStudentClassInterface
   *   The called IEK Student Class entity.
   */
  public function setName($name);

  /**
   * Gets the IEK Student Class creation timestamp.
   *
   * @return int
   *   Creation timestamp of the IEK Student Class.
   */
  public function getCreatedTime();

  /**
   * Sets the IEK Student Class creation timestamp.
   *
   * @param int $timestamp
   *   The IEK Student Class creation timestamp.
   *
   * @return \Drupal\iek\Entity\EpalStudentClassInterface
   *   The called IEK Student Class entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the IEK Student Class published status indicator.
   *
   * Unpublished IEK Student Class are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the IEK Student Class is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a IEK Student Class.
   *
   * @param bool $published
   *   TRUE to set this IEK Student Class to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iek\Entity\EpalStudentClassInterface
   *   The called IEK Student Class entity.
   */
  public function setPublished($published);

  /**
   * Gets the IEK Student Class Minno.
   *
   * @return int
   *   Creation timestamp of the IEK Student Class.
   */
  public function getMinno();

  /**
   * Sets the IEK Student Class Minno.
   *
   * @param int $minno
   *   The IEK Student Class Minno.
   *
   * @return \Drupal\iek\Entity\EpalStudentClassInterface
   *   The called IEK Student Class entity.
   */
  public function setMinno($minno);

  /**
   * Gets the IEK Student Class Maxno.
   *
   * @return int
   *   Creation timestamp of the IEK Student Class.
   */
  public function getMaxno();

  /**
   * Sets the IEK Student Class Maxno.
   *
   * @param int $maxno
   *   The IEK Student Class Maxno.
   *
   * @return \Drupal\iek\Entity\EpalStudentClassInterface
   *   The called IEK Student Class entity.
   */
  public function setMaxno($maxno);

}
