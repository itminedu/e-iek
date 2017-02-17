<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\eiek\Entity\EidikotitaEntityInterface;

/**
 * Defines the storage handler class for Eidikotita entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Eidikotita entity entities.
 *
 * @ingroup eiek
 */
interface EidikotitaEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Eidikotita entity revision IDs for a specific Eidikotita entity.
   *
   * @param \Drupal\eiek\Entity\EidikotitaEntityInterface $entity
   *   The Eidikotita entity entity.
   *
   * @return int[]
   *   Eidikotita entity revision IDs (in ascending order).
   */
  public function revisionIds(EidikotitaEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Eidikotita entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Eidikotita entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\eiek\Entity\EidikotitaEntityInterface $entity
   *   The Eidikotita entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(EidikotitaEntityInterface $entity);

  /**
   * Unsets the language for all Eidikotita entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
