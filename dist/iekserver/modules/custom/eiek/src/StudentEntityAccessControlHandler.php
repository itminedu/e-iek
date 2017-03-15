<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Student entity entity.
 *
 * @see \Drupal\eiek\Entity\StudentEntity.
 */
class StudentEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\eiek\Entity\StudentEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished student entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published student entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit student entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete student entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add student entity entities');
  }

}
