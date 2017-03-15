<?php

namespace Drupal\eiek\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\eiek\Entity\AitisiEntityInterface;

/**
 * Class AitisiEntityController.
 *
 *  Returns responses for Aitisi entity routes.
 *
 * @package Drupal\eiek\Controller
 */
class AitisiEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Aitisi entity  revision.
   *
   * @param int $aitisi_entity_revision
   *   The Aitisi entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($aitisi_entity_revision) {
    $aitisi_entity = $this->entityManager()->getStorage('aitisi_entity')->loadRevision($aitisi_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('aitisi_entity');

    return $view_builder->view($aitisi_entity);
  }

  /**
   * Page title callback for a Aitisi entity  revision.
   *
   * @param int $aitisi_entity_revision
   *   The Aitisi entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($aitisi_entity_revision) {
    $aitisi_entity = $this->entityManager()->getStorage('aitisi_entity')->loadRevision($aitisi_entity_revision);
    return $this->t('Revision of %title from %date', array('%title' => $aitisi_entity->label(), '%date' => format_date($aitisi_entity->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Aitisi entity .
   *
   * @param \Drupal\eiek\Entity\AitisiEntityInterface $aitisi_entity
   *   A Aitisi entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(AitisiEntityInterface $aitisi_entity) {
    $account = $this->currentUser();
    $langcode = $aitisi_entity->language()->getId();
    $langname = $aitisi_entity->language()->getName();
    $languages = $aitisi_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $aitisi_entity_storage = $this->entityManager()->getStorage('aitisi_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $aitisi_entity->label()]) : $this->t('Revisions for %title', ['%title' => $aitisi_entity->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all aitisi entity revisions") || $account->hasPermission('administer aitisi entity entities')));
    $delete_permission = (($account->hasPermission("delete all aitisi entity revisions") || $account->hasPermission('administer aitisi entity entities')));

    $rows = array();

    $vids = $aitisi_entity_storage->revisionIds($aitisi_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\eiek\AitisiEntityInterface $revision */
      $revision = $aitisi_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $aitisi_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.aitisi_entity.revision', ['aitisi_entity' => $aitisi_entity->id(), 'aitisi_entity_revision' => $vid]));
        }
        else {
          $link = $aitisi_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->revision_log_message->value, '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => Url::fromRoute('aitisi_entity.revision_revert_confirm', ['aitisi_entity' => $aitisi_entity->id(), 'aitisi_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('aitisi_entity.revision_delete_confirm', ['aitisi_entity' => $aitisi_entity->id(), 'aitisi_entity_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['aitisi_entity_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
