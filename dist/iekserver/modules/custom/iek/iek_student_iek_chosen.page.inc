<?php

/**
 * @file
 * Contains iek_student_iek_chosen.page.inc.
 *
 * Page callback for Epal student iek chosen entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Epal student iek chosen templates.
 *
 * Default template: iek_student_iek_chosen.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_iek_student_iek_chosen(array &$variables) {
  // Fetch EpalStudentEpalChosen Entity Object.
  $iek_student_iek_chosen = $variables['elements']['#iek_student_iek_chosen'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
