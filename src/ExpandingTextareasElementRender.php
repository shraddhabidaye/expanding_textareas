<?php

namespace Drupal\expanding_textareas;

use Drupal\Core\Security\TrustedCallbackInterface;

/**
 * Class ExpandingTextareasElementRender.
 *
 * Process a text format widget to load and attach expanding textareas format.
 */
class ExpandingTextareasElementRender implements TrustedCallbackInterface {

  /**
   * {@inheritdoc}
   */
  public static function trustedCallbacks() {
    return ['preRenderTextFormat'];
  }

  /**
   * Pre-render callback for field output used with tokens.
   */
  public static function preRenderTextFormat($element) {
    $field = &$element;
    $config = \Drupal::config('expanding_textareas.settings');
    if (($config->get('expanding_textareas_admin_fields') == '*') || (in_array($field['#id'], array_map('trim', explode("\n", $config->get('expanding_textareas_admin_fields')))))) {
      $element['#attributes']['class'][] = 'expanding';
      $element['#attached']['library'][] = 'expanding_textareas/expanding';
    }
    return $element;
  }

}
