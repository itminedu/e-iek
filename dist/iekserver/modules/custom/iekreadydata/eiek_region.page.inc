<?php

/**
 * @file
 * Contains eiek_region.page.inc.
 *
 * Page callback for Eiek region entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Eiek region templates.
 *
 * Default template: eiek_region.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_region(array &$variables) {
  // Fetch EiekRegion Entity Object.
  $eiek_region = $variables['elements']['#eiek_region'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
