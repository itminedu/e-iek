<?php

/**
 * @file
 * Contains eiek_sectors.page.inc.
 *
 * Page callback for Eiek sectors entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Eiek sectors templates.
 *
 * Default template: eiek_sectors.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_sectors(array &$variables) {
  // Fetch EiekSectors Entity Object.
  $eiek_sectors = $variables['elements']['#eiek_sectors'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
