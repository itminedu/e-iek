<?php

namespace Drupal\eiek;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Eidikotita entity entity.
 *
 * @see \Drupal\eiek\Entity\EidikotitaEntity.
 */
class EidikotitaEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\eiek\Entity\EidikotitaEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished eidikotita entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published eidikotita entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit eidikotita entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete eidikotita entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add eidikotita entity entities');
  }

}
