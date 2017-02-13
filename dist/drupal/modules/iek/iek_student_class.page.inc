<?php

/**
 * @file
 * Contains iek_student_class.page.inc.
 *
 * Page callback for IEK Student Class entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for IEK Student Class templates.
 *
 * Default template: iek_student_class.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_iek_student_class(array &$variables) {
  // Fetch EpalStudentClass Entity Object.
  $iek_student_class = $variables['elements']['#iek_student_class'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
