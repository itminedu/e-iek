<?php

/**
 * @file
 * Contains student_entity.page.inc.
 *
 * Page callback for Student entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Student entity templates.
 *
 * Default template: student_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_student_entity(array &$variables) {
  // Fetch StudentEntity Entity Object.
  $student_entity = $variables['elements']['#student_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
