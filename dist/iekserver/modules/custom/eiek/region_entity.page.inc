<?php

/**
 * @file
 * Contains region_entity.page.inc.
 *
 * Page callback for Region entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Region entity templates.
 *
 * Default template: region_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_region_entity(array &$variables) {
  // Fetch RegionEntity Entity Object.
  $region_entity = $variables['elements']['#region_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
