<?php

/**
 * @file
 * Contains eidikotita_entity.page.inc.
 *
 * Page callback for Eidikotita entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Eidikotita entity templates.
 *
 * Default template: eidikotita_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_eidikotita_entity(array &$variables) {
  // Fetch EidikotitaEntity Entity Object.
  $eidikotita_entity = $variables['elements']['#eidikotita_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
