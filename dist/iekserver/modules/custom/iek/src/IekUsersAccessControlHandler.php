<?php

namespace Drupal\iek;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Epal users entity.
 *
 * @see \Drupal\iek\Entity\EpalUsers.
 */
class EpalUsersAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iek\Entity\EpalUsersInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished iek users entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published iek users entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit iek users entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete iek users entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add iek users entities');
  }

}
