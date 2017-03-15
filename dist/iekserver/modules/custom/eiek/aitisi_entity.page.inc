<?php

/**
 * @file
 * Contains aitisi_entity.page.inc.
 *
 * Page callback for Aitisi entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Aitisi entity templates.
 *
 * Default template: aitisi_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_aitisi_entity(array &$variables) {
  // Fetch AitisiEntity Entity Object.
  $aitisi_entity = $variables['elements']['#aitisi_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
