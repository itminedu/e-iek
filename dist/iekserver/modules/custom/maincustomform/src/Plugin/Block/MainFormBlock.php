<?php

namespace Drupal\maincustomform\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'MainFormBlock' block.
 *
 * @Block(
 *  id = "main_form_block",
 *  admin_label = @Translation("Main form block"),
 * )
 */
class MainFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    //$build = [];
    //$build['main_form_block']['#markup'] = 'Implement MainFormBlock.';


    $builtForm = \Drupal::formBuilder()->getForm('Drupal\maincustomform\Form\MultistepFormBase');
    $renderArray['form'] = $builtForm;

    return $renderArray;
  }

}
