<?php

namespace Drupal\d8views\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Random;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;


/**
 * A handler to provide a field that is completely custom by the administrator.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("baseurlvalue")
 */
class BaseUrlValue extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function usesGroupBy() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Do nothing -- to override the parent query.
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    //$options['hide_alter_empty'] = ['default' => FALSE];
    //$options['node_type'] = array('default' => 'article');
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
   // $types = NodeType::loadMultiple();
  //  $options = [];
  /*  foreach ($types as $key => $type) {
      $options[$key] = $type->label();
    }
    $form['node_type'] = array(
      '#title' => $this->t('Which node type should be flagged?'),
      '#type' => 'select',
      '#default_value' => $this->options['node_type'],
      '#options' => $options,
    );*/
 
    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    // Return a random text, here you can include your custom logic.
    // Include any namespace required to call the method required to generate
    // the desired output.
    //$random = new Random();
    //return $random->name();
    global $base_url;
    return $base_url;

  }

}
