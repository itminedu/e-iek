<?php

namespace Drupal\Tests\jsonapi\Kernel;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\KernelTests\KernelTestBase;

/**
 * @internal
 */
abstract class JsonapiKernelTestBase extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['jsonapi'];

  /**
   * Creates a field of an entity reference field storage on the bundle.
   *
   * @param string $entity_type
   *   The type of entity the field will be attached to.
   * @param string $bundle
   *   The bundle name of the entity the field will be attached to.
   * @param string $field_name
   *   The name of the field; if it exists, a new instance of the existing.
   *   field will be created.
   * @param string $field_label
   *   The label of the field.
   * @param string $target_entity_type
   *   The type of the referenced entity.
   * @param string $selection_handler
   *   The selection handler used by this field.
   * @param array $handler_settings
   *   An array of settings supported by the selection handler specified above.
   *   (e.g. 'target_bundles', 'sort', 'auto_create', etc).
   * @param int $cardinality
   *   The cardinality of the field.
   *
   * @see \Drupal\Core\Entity\Plugin\EntityReferenceSelection\SelectionBase::buildConfigurationForm()
   */
  protected function createEntityReferenceField($entity_type, $bundle, $field_name, $field_label, $target_entity_type, $selection_handler = 'default', $handler_settings = array(), $cardinality = 1) {
    // Look for or add the specified field to the requested entity bundle.
    if (!FieldStorageConfig::loadByName($entity_type, $field_name)) {
      FieldStorageConfig::create(array(
        'field_name' => $field_name,
        'type' => 'entity_reference',
        'entity_type' => $entity_type,
        'cardinality' => $cardinality,
        'settings' => array(
          'target_type' => $target_entity_type,
        ),
      ))->save();
    }
    if (!FieldConfig::loadByName($entity_type, $bundle, $field_name)) {
      FieldConfig::create(array(
        'field_name' => $field_name,
        'entity_type' => $entity_type,
        'bundle' => $bundle,
        'label' => $field_label,
        'settings' => array(
          'handler' => $selection_handler,
          'handler_settings' => $handler_settings,
        ),
      ))->save();
    }
  }

}
