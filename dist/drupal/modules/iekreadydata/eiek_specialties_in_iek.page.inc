<?php

/**
 * @file
 * Contains eiek_specialties_in_iek.page.inc.
 *
 * Page callback for Eiek specialties in iek entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Eiek specialties in iek templates.
 *
 * Default template: eiek_specialties_in_iek.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eiek_specialties_in_iek(array &$variables) {
  // Fetch EiekSpecialtiesInEpal Entity Object.
  $eiek_specialties_in_iek = $variables['elements']['#eiek_specialties_in_iek'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
