<?php

/**
 * @file
 * Contains iek_student_course_field.page.inc.
 *
 * Page callback for Epal student course field entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Epal student course field templates.
 *
 * Default template: iek_student_course_field.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_iek_student_course_field(array &$variables) {
  // Fetch EpalStudentCourseField Entity Object.
  $iek_student_course_field = $variables['elements']['#iek_student_course_field'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
