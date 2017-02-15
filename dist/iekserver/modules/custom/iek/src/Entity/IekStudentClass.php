<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the IEK Student Class entity.
 *
 * @ingroup iek
 *
 * @ContentEntityType(
 *   id = "iek_student_class",
 *   label = @Translation("IEK Student Class"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iek\EpalStudentClassListBuilder",
 *     "views_data" = "Drupal\iek\Entity\EpalStudentClassViewsData",
 *     "translation" = "Drupal\iek\EpalStudentClassTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\iek\Form\EpalStudentClassForm",
 *       "add" = "Drupal\iek\Form\EpalStudentClassForm",
 *       "edit" = "Drupal\iek\Form\EpalStudentClassForm",
 *       "delete" = "Drupal\iek\Form\EpalStudentClassDeleteForm",
 *     },
 *     "access" = "Drupal\iek\EpalStudentClassAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\iek\EpalStudentClassHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "iek_student_class",
 *   data_table = "iek_student_class_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer iek student class entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *     "minno" = "minno",
 *     "maxno" = "maxno",
 *   },
 *   links = {
 *     "canonical" = "/admin/iek/iek_student_class/{iek_student_class}",
 *     "add-form" = "/admin/iek/iek_student_class/add",
 *     "edit-form" = "/admin/iek/iek_student_class/{iek_student_class}/edit",
 *     "delete-form" = "/admin/iek/iek_student_class/{iek_student_class}/delete",
 *     "collection" = "/admin/iek/iek_student_class",
 *   },
 *   field_ui_base_route = "iek_student_class.settings"
 * )
 */
class EpalStudentClass extends ContentEntityBase implements EpalStudentClassInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getMinno() {
    return $this->get('minno')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setMinno($minno) {
    $this->set('minno', $minno);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getMaxno() {
    return $this->get('maxno')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setMaxno($maxno) {
    $this->set('maxno', $maxno);
    return $this;
  }



  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the IEK Student Class entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the IEK Student Class entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the IEK Student Class is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));


      $fields['maxno'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('Max Number of Students'))
          ->setDescription(t('The maximum number of students in class.'))
          ->setSettings(array(
            'max_length' => 2,
            'text_processing' => 0,
          ))
          ->setDefaultValue(25)
          ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'integer',
            'weight' => -4,
          ))
          ->setDisplayOptions('form', array(
            'type' => 'integer',
            'weight' => -4,
          ))
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

      $fields['minno'] = BaseFieldDefinition::create('integer')
              ->setLabel(t('Min Number of Students'))
              ->setDescription(t('The minimum number of students in class.'))
              ->setSettings(array(
                'max_length' => 2,
                'text_processing' => 0,
              ))
              ->setDefaultValue(25)
              ->setDisplayOptions('view', array(
                'label' => 'above',
                'type' => 'integer',
                'weight' => -4,
              ))
              ->setDisplayOptions('form', array(
                'type' => 'integer',
                'weight' => -4,
              ))
              ->setDisplayConfigurable('form', TRUE)
              ->setDisplayConfigurable('view', TRUE);


    return $fields;
  }

}
