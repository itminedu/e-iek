<?php

/**
 * @file
 * Contains eiek_admin_area.page.inc.
 *
 * Page callback for Eiek admin area entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Eiek admin area templates.
 *
 * Default template: eiek_admin_area.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_admin_area(array &$variables) {
  // Fetch EiekAdminArea Entity Object.
  $eiek_admin_area = $variables['elements']['#eiek_admin_area'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
