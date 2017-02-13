<?php

/**
 * @file
 * Contains eiek_specialty.page.inc.
 *
 * Page callback for Eiek specialty entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Eiek specialty templates.
 *
 * Default template: eiek_specialty.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_specialty(array &$variables) {
  // Fetch EiekSpecialty Entity Object.
  $eiek_specialty = $variables['elements']['#eiek_specialty'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
