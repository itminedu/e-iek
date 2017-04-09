<?php

/**
 * @file
 * Contains d8views\d8views.views.inc..
 * Provide a custom views field data that isn't tied to any other module. */

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Render\Markup;
use Drupal\field\FieldConfigInterface;
use Drupal\field\FieldStorageConfigInterface;
use Drupal\system\ActionConfigEntityInterface;

/**
 * Implements hook_views_data_alter().
 */
function d8views_views_data_alter(array &$data) {
  $data['aitisi_entity']['node_type_flagger'] = array(
    'title' => t('Node type flagger'),
    'field' => array(
      'title' => t('Node type flagger'),
      'help' => t('Flags a specific node type.'),
      'id' => 'node_type_flagger',
    ),
  );

  $data['aitisi_entity']['baseurlvalue'] = array(
    'title' => t('Base URL value'),
    'field' => array(
      'title' => t('Base URL value'),
      'id' => 'baseurlvalue',
    ),
  );

  $data['aitisi_entity']['node_type_filter'] = array(
    'title' => t('Enhanced node type filter'),
    'filter' => array(
      'title' => t('Enhanced node type filter'),
      'help' => t('Provides a custom filter for nodes by their type.'),
      'field' => 'type',
      'id' => 'string'
    ),
  );

   $data['aitisi_entity']['nodes_titles'] = array(
    'title' => t('Node titles'),
    'filter' => array(
      'title' => t('Node titles'),
      'help' => t('Specify a list of titles a node can have.'),
      'field' => 'iek_id',
      'id' => 'd8views_node_titles'
    ),
  );

}

