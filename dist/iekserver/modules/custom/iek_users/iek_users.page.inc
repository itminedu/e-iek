<?php

/**
 * @file
 * Contains iek_users.page.inc.
 *
 * Page callback for Iek users entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Iek users templates.
 *
 * Default template: iek_users.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_iek_users(array &$variables) {
  // Fetch IekUsers Entity Object.
  $iek_users = $variables['elements']['#iek_users'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
