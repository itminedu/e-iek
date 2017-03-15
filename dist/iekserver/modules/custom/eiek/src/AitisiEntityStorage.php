<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class AitisiEntityStorage extends SqlContentEntityStorage implements AitisiEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(AitisiEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {aitisi_entity_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {aitisi_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(AitisiEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {aitisi_entity_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('aitisi_entity_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
