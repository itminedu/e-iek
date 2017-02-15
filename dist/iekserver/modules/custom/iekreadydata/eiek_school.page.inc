<?php

/**
 * @file
 * Contains eiek_school.page.inc.
 *
 * Page callback for Eiek school entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Eiek school templates.
 *
 * Default template: eiek_school.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_school(array &$variables) {
  // Fetch EiekSchool Entity Object.
  $eiek_school = $variables['elements']['#eiek_school'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
