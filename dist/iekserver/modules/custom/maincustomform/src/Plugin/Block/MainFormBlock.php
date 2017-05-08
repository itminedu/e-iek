<?php

namespace Drupal\maincustomform\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManagerInterface;

/**
 * Provides a 'MainFormBlock' block.
 *
 * @Block(
 *  id = "main_form_block",
 *  admin_label = @Translation("Main form block"),
 * )
 */
class MainFormBlock extends BlockBase implements ContainerFactoryPluginInterface {



  protected $entity_manager;

    /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountProxyInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityManagerInterface $entity_manager) {
    $this->entity_manager = $entity_manager;
  }


  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.manager')
    );
  }



  /**
   * {@inheritdoc}
   */
  public function build() {
    $userCurrent = \Drupal::currentUser();
    $user_id = $userCurrent->id();
    $user = \Drupal\user\Entity\User::load($userCurrent->id());
    
    $userRoles = $userCurrent->getRoles();
    $url_out = \Drupal::url('user.logout');
    $url_in = \Drupal::url('user.login');

    $studentUsers = $this->entity_manager->getStorage('student_entity')->loadByProperties(array('user_id' => $user_id));
    $studentUser = reset($studentUsers);
    
    
    if(in_array("administrator", $userRoles)) {
      $role = "Διαχειριστής Συστήματος";
      $name = $user->getUsername();
    } else if(in_array("aiton", $userRoles)) {
      $role = "Αιτών";
      if($studentUser)
       $name = $studentUser->getLast().' '.$studentUser->getFirst();
      else 
        $name = 'Αρχικό';

    } else if(in_array("diaxeiristis_iek", $userRoles)) {
      $role = "Διαχειριστής ΙΕΚ";
      $name = $user->getUsername();
    } else if(in_array("diaxeiristis_eoppep", $userRoles)) {
      $role = "Διαχειριστής ΕΟΠΠΕΠ";
      $name = $user->getUsername();
    } 




   return array(
    '#url_out' => $url_out,
    '#url_in' => $url_in,
    '#name' => $name, 
    '#role' => $role,
    '#theme' => 'maincustomform_block'
  );

    //return $renderArray;
  }

}
