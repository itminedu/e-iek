<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Eiek region entity.
 *
 * @see \Drupal\iekreadydata\Entity\EiekRegion.
 */
class EiekRegionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iekreadydata\Entity\EiekRegionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished eiek region entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published eiek region entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit eiek region entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete eiek region entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add eiek region entities');
  }

}
