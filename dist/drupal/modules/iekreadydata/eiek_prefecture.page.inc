<?php

/**
 * @file
 * Contains eiek_prefecture.page.inc.
 *
 * Page callback for Eiek prefecture entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Eiek prefecture templates.
 *
 * Default template: eiek_prefecture.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_prefecture(array &$variables) {
  // Fetch EiekPrefecture Entity Object.
  $eiek_prefecture = $variables['elements']['#eiek_prefecture'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
