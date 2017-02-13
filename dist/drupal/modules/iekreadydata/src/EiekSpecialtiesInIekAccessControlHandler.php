<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Eiek specialties in iek entity.
 *
 * @see \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpal.
 */
class EiekSpecialtiesInEpalAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iekreadydata\Entity\EiekSpecialtiesInEpalInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished eiek specialties in iek entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published eiek specialties in iek entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit eiek specialties in iek entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete eiek specialties in iek entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add eiek specialties in iek entities');
  }

}
