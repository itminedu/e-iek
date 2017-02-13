<?php

namespace Drupal\iekreadydata;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Eiek prefecture entity.
 *
 * @see \Drupal\iekreadydata\Entity\EiekPrefecture.
 */
class EiekPrefectureAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iekreadydata\Entity\EiekPrefectureInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished eiek prefecture entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published eiek prefecture entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit eiek prefecture entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete eiek prefecture entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add eiek prefecture entities');
  }

}
