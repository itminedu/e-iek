<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Eiek admin area entity.
 *
 * @see \Drupal\iekreadydata\Entity\EiekAdminArea.
 */
class EiekAdminAreaAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iekreadydata\Entity\EiekAdminAreaInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished eiek admin area entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published eiek admin area entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit eiek admin area entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete eiek admin area entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add eiek admin area entities');
  }

}
