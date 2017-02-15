<?php

namespace Drupal\iek;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Epal student course field entity.
 *
 * @see \Drupal\iek\Entity\EpalStudentCourseField.
 */
class EpalStudentCourseFieldAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iek\Entity\EpalStudentCourseFieldInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished iek student course field entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published iek student course field entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit iek student course field entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete iek student course field entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add iek student course field entities');
  }

}
