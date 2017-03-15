<?php

namespace Drupal\eiek\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\eiek\Entity\StudentEntityInterface;

/**
 * Class StudentEntityController.
 *
 *  Returns responses for Student entity routes.
 *
 * @package Drupal\eiek\Controller
 */
class StudentEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Student entity  revision.
   *
   * @param int $student_entity_revision
   *   The Student entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($student_entity_revision) {
    $student_entity = $this->entityManager()->getStorage('student_entity')->loadRevision($student_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('student_entity');

    return $view_builder->view($student_entity);
  }

  /**
   * Page title callback for a Student entity  revision.
   *
   * @param int $student_entity_revision
   *   The Student entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($student_entity_revision) {
    $student_entity = $this->entityManager()->getStorage('student_entity')->loadRevision($student_entity_revision);
    return $this->t('Revision of %title from %date', array('%title' => $student_entity->label(), '%date' => format_date($student_entity->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Student entity .
   *
   * @param \Drupal\eiek\Entity\StudentEntityInterface $student_entity
   *   A Student entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(StudentEntityInterface $student_entity) {
    $account = $this->currentUser();
    $langcode = $student_entity->language()->getId();
    $langname = $student_entity->language()->getName();
    $languages = $student_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $student_entity_storage = $this->entityManager()->getStorage('student_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $student_entity->label()]) : $this->t('Revisions for %title', ['%title' => $student_entity->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all student entity revisions") || $account->hasPermission('administer student entity entities')));
    $delete_permission = (($account->hasPermission("delete all student entity revisions") || $account->hasPermission('administer student entity entities')));

    $rows = array();

    $vids = $student_entity_storage->revisionIds($student_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\eiek\StudentEntityInterface $revision */
      $revision = $student_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $student_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.student_entity.revision', ['student_entity' => $student_entity->id(), 'student_entity_revision' => $vid]));
        }
        else {
          $link = $student_entity->link($date);
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
              'url' => Url::fromRoute('student_entity.revision_revert_confirm', ['student_entity' => $student_entity->id(), 'student_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('student_entity.revision_delete_confirm', ['student_entity' => $student_entity->id(), 'student_entity_revision' => $vid]),
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

    $build['student_entity_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
