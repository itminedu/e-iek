<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Eiek specialty entity.
 *
 * @see \Drupal\iekreadydata\Entity\EiekSpecialty.
 */
class EiekSpecialtyAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iekreadydata\Entity\EiekSpecialtyInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished eiek specialty entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published eiek specialty entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit eiek specialty entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete eiek specialty entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add eiek specialty entities');
  }

}
