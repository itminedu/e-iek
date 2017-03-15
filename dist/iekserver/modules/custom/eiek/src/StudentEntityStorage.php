<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class StudentEntityStorage extends SqlContentEntityStorage implements StudentEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(StudentEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {student_entity_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {student_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(StudentEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {student_entity_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('student_entity_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
