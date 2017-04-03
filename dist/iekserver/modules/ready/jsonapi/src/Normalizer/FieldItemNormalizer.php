<?php

namespace Drupal\jsonapi\Normalizer;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\jsonapi\Normalizer\Value\FieldItemNormalizerValue;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Converts the Drupal field item object to a JSON API array structure.
 */
class FieldItemNormalizer extends NormalizerBase {

  /**
   * The interface or class that this Normalizer supports.
   *
   * @var string
   */
  protected $supportedInterfaceOrClass = FieldItemInterface::class;

  /**
   * The formats that the Normalizer can handle.
   *
   * @var array
   */
  protected $formats = array('api_json');

  /**
   * {@inheritdoc}
   */
  public function normalize($field_item, $format = NULL, array $context = array()) {
    $values = $field_item->toArray();
    if (isset($context['langcode'])) {
      $values['lang'] = $context['langcode'];
    }
    return new FieldItemNormalizerValue($values);
  }

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = array()) {
    throw new UnexpectedValueException('Denormalization not implemented for JSON API');
  }

}
