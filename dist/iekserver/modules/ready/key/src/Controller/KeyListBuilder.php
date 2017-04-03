<?php

namespace Drupal\key\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a listing of keys.
 *
 * @see \Drupal\key\Entity\Key
 */
class KeyListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage) {
    parent::__construct($entity_type, $storage);
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id())
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Key');
    $header['type'] = [
      'data' => $this->t('Type'),
      'class' => [RESPONSIVE_PRIORITY_MEDIUM],
    ];
    $header['provider'] = [
      'data' => $this->t('Provider'),
      'class' => [RESPONSIVE_PRIORITY_MEDIUM],
    ];

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $key \Drupal\key\Entity\Key */
    $key = $entity;

    $row['label'] = $key->label();
    $row['type'] = $key->getKeyType()->getPluginDefinition()['label'];
    $row['provider'] = $key->getKeyProvider()->getPluginDefinition()['label'];

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();
    $build['table']['#empty'] = $this->t('No keys are available. <a href=":link">Add a key</a>.', [':link' => Url::fromRoute('entity.key.add_form')->toString()]);
    return $build;
  }

}
