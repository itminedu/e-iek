<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\eiek\Entity\AitisiEntityInterface;

/**
 * Defines the storage handler class for Aitisi entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Aitisi entity entities.
 *
 * @ingroup eiek
 */
interface AitisiEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Aitisi entity revision IDs for a specific Aitisi entity.
   *
   * @param \Drupal\eiek\Entity\AitisiEntityInterface $entity
   *   The Aitisi entity entity.
   *
   * @return int[]
   *   Aitisi entity revision IDs (in ascending order).
   */
  public function revisionIds(AitisiEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Aitisi entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Aitisi entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\eiek\Entity\AitisiEntityInterface $entity
   *   The Aitisi entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(AitisiEntityInterface $entity);

  /**
   * Unsets the language for all Aitisi entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
