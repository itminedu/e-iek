<?php

/**
 * @file
 * Contains iek_student.page.inc.
 *
 * Page callback for IEK Student entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for IEK Student templates.
 *
 * Default template: iek_student.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_iek_student(array &$variables) {
  // Fetch EpalStudent Entity Object.
  $iek_student = $variables['elements']['#iek_student'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
