<?php

/**
 * @file
 * Contains school_entity.page.inc.
 *
 * Page callback for School entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for School entity templates.
 *
 * Default template: school_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_school_entity(array &$variables) {
  // Fetch SchoolEntity Entity Object.
  $school_entity = $variables['elements']['#school_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
