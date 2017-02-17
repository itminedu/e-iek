<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\eiek\Entity\StudentEntityInterface;

/**
 * Defines the storage handler class for Student entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Student entity entities.
 *
 * @ingroup eiek
 */
interface StudentEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Student entity revision IDs for a specific Student entity.
   *
   * @param \Drupal\eiek\Entity\StudentEntityInterface $entity
   *   The Student entity entity.
   *
   * @return int[]
   *   Student entity revision IDs (in ascending order).
   */
  public function revisionIds(StudentEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Student entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Student entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\eiek\Entity\StudentEntityInterface $entity
   *   The Student entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(StudentEntityInterface $entity);

  /**
   * Unsets the language for all Student entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
