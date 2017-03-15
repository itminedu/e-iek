<?php

namespace Drupal\eiek\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\eiek\Entity\EidikotitaEntityInterface;

/**
 * Class EidikotitaEntityController.
 *
 *  Returns responses for Eidikotita entity routes.
 *
 * @package Drupal\eiek\Controller
 */
class EidikotitaEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Eidikotita entity  revision.
   *
   * @param int $eidikotita_entity_revision
   *   The Eidikotita entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($eidikotita_entity_revision) {
    $eidikotita_entity = $this->entityManager()->getStorage('eidikotita_entity')->loadRevision($eidikotita_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('eidikotita_entity');

    return $view_builder->view($eidikotita_entity);
  }

  /**
   * Page title callback for a Eidikotita entity  revision.
   *
   * @param int $eidikotita_entity_revision
   *   The Eidikotita entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($eidikotita_entity_revision) {
    $eidikotita_entity = $this->entityManager()->getStorage('eidikotita_entity')->loadRevision($eidikotita_entity_revision);
    return $this->t('Revision of %title from %date', array('%title' => $eidikotita_entity->label(), '%date' => format_date($eidikotita_entity->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Eidikotita entity .
   *
   * @param \Drupal\eiek\Entity\EidikotitaEntityInterface $eidikotita_entity
   *   A Eidikotita entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(EidikotitaEntityInterface $eidikotita_entity) {
    $account = $this->currentUser();
    $langcode = $eidikotita_entity->language()->getId();
    $langname = $eidikotita_entity->language()->getName();
    $languages = $eidikotita_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $eidikotita_entity_storage = $this->entityManager()->getStorage('eidikotita_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $eidikotita_entity->label()]) : $this->t('Revisions for %title', ['%title' => $eidikotita_entity->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all eidikotita entity revisions") || $account->hasPermission('administer eidikotita entity entities')));
    $delete_permission = (($account->hasPermission("delete all eidikotita entity revisions") || $account->hasPermission('administer eidikotita entity entities')));

    $rows = array();

    $vids = $eidikotita_entity_storage->revisionIds($eidikotita_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\eiek\EidikotitaEntityInterface $revision */
      $revision = $eidikotita_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $eidikotita_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.eidikotita_entity.revision', ['eidikotita_entity' => $eidikotita_entity->id(), 'eidikotita_entity_revision' => $vid]));
        }
        else {
          $link = $eidikotita_entity->link($date);
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
              'url' => Url::fromRoute('eidikotita_entity.revision_revert_confirm', ['eidikotita_entity' => $eidikotita_entity->id(), 'eidikotita_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('eidikotita_entity.revision_delete_confirm', ['eidikotita_entity' => $eidikotita_entity->id(), 'eidikotita_entity_revision' => $vid]),
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

    $build['eidikotita_entity_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
