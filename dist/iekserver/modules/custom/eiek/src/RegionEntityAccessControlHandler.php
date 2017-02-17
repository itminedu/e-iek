<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Region entity entity.
 *
 * @see \Drupal\eiek\Entity\RegionEntity.
 */
class RegionEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\eiek\Entity\RegionEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished region entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published region entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit region entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete region entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add region entity entities');
  }

}
