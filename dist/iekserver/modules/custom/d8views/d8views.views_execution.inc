<?php

function d8views_views_query_alter(Drupal\views\ViewExecutable $view, Drupal\views\Plugin\views\query\Sql $query) {
if ($view->id() == 'test1') {
 
    foreach ($query->where as &$condition_group) {
      foreach ($condition_group['conditions'] as &$condition) {
       // dpm($condition);
        if ($condition['field'] == 'school_entity_aitisi_entity.iekcode') {

          $user = \Drupal::service('current_user');
          $uid = $user->id();
          //$formatted_name = $user->getDisplayName();
          $raw_name = $user->getAccountName();
          //$raw_name = 'admin';

          $condition = array(
            'field' => 'school_entity_aitisi_entity.iekcode',
            'value' => $raw_name,
            'operator' => '=',
          );
        }

        if ($condition['field'] == 'aitisi_entity.user_id') {

          $user = \Drupal::service('current_user');
          $uid = $user->id();
          //$formatted_name = $user->getDisplayName();
          //$raw_name = $user->getAccountName();
          //$raw_name = 'admin';

          $condition = array(
            'field' => 'aitisi_entity.user_id',
            'value' => $uid,
            'operator' => '=',
          );
        }


      }
    }
  }

}