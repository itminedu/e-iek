<?php
/**
 * @file
 * Definition of Drupal\d8views\Plugin\views\filter\NodeTitles.
 */
namespace Drupal\d8views\Plugin\views\filter;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\filter\InOperator;
use Drupal\views\ViewExecutable;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Filters by given list of node title options.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("d8views_node_titles")
 */
class NodeTitles extends InOperator implements ContainerFactoryPluginInterface {

   protected $user;

   public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->user = $user;
   }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    //$this->valueTitle = t('Allowed node titles');
   // $this->definition['options callback'] = array($this, 'generateOptions');
    $uid = $this->user->id();
    //$formatted_name = $this->user->getDisplayName();
    $raw_name = $this->user->getAccountName();
    $this->value = $raw_name;

  }
  /**
   * Override the query so that no filtering takes place if the user doesn't
   * select any options.
   */
  public function query() {
    if (!empty($this->value)) {
      parent::query();
    }
  }
  /**
   * Skip validation if no options have been chosen so we can use it as a
   * non-filter.
   */
  public function validate() {
    if (!empty($this->value)) {
      parent::validate();
    }
  }
  /**
   * Helper function that generates the options.
   * @return array
   */
  public function generateOptions() {

    // Array keys are used to compare with the table field values.
    $uid = $this->user->id();
    //$formatted_name = $this->user->getDisplayName();
    $raw_name = $this->user->getAccountName();

    return array(
      'user name' => $raw_name
    );
  }
}