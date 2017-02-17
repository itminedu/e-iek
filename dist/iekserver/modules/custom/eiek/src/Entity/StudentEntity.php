<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Student entity entity.
 *
 * @ingroup eiek
 *
 * @ContentEntityType(
 *   id = "student_entity",
 *   label = @Translation("Student entity"),
 *   handlers = {
 *     "storage" = "Drupal\eiek\StudentEntityStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\eiek\StudentEntityListBuilder",
 *     "views_data" = "Drupal\eiek\Entity\StudentEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\eiek\Form\StudentEntityForm",
 *       "add" = "Drupal\eiek\Form\StudentEntityForm",
 *       "edit" = "Drupal\eiek\Form\StudentEntityForm",
 *       "delete" = "Drupal\eiek\Form\StudentEntityDeleteForm",
 *     },
 *     "access" = "Drupal\eiek\StudentEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\eiek\StudentEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "student_entity",
 *   revision_table = "student_entity_revision",
 *   revision_data_table = "student_entity_field_revision",
 *   admin_permission = "administer student entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "last",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/student_entity/{student_entity}",
 *     "add-form" = "/admin/structure/student_entity/add",
 *     "edit-form" = "/admin/structure/student_entity/{student_entity}/edit",
 *     "delete-form" = "/admin/structure/student_entity/{student_entity}/delete",
 *     "version-history" = "/admin/structure/student_entity/{student_entity}/revisions",
 *     "revision" = "/admin/structure/student_entity/{student_entity}/revisions/{student_entity_revision}/view",
 *     "revision_delete" = "/admin/structure/student_entity/{student_entity}/revisions/{student_entity_revision}/delete",
 *     "collection" = "/admin/structure/student_entity",
 *   },
 *   field_ui_base_route = "student_entity.settings"
 * )
 */
class StudentEntity extends RevisionableContentEntityBase implements StudentEntityInterface {

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
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }

    // If no revision author has been set explicitly, make the student_entity owner the
    // revision author.
    if (!$this->getRevisionUser()) {
      $this->setRevisionUserId($this->getOwnerId());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getLast() {
    return $this->get('last')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setLast($last) {
    $this->set('last', $last);
    return $this;
  }

    /**
   * {@inheritdoc}
   */
  public function getFirst() {
    return $this->get('first')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setFirst($first) {
    $this->set('first', $first);
    return $this;
  }

    /**
   * {@inheritdoc}
   */
  public function getFname() {
    return $this->get('fname')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setFname($fname) {
    $this->set('fname', $fname);
    return $this;
  }

    /**
   * {@inheritdoc}
   */
  public function getMname() {
    return $this->get('mname')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setMname($mname) {
    $this->set('mname', $mname);
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
  public function getRevisionCreationTime() {
    return $this->get('revision_timestamp')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRevisionCreationTime($timestamp) {
    $this->set('revision_timestamp', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRevisionUser() {
    return $this->get('revision_uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function setRevisionUserId($uid) {
    $this->set('revision_uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Student entity entity.'))
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

    $fields['last'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Last Name'))
      ->setDescription(t('The last name of the Student entity entity.'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 60,
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


    $fields['first'] = BaseFieldDefinition::create('string')
      ->setLabel(t('First Name'))
      ->setDescription(t('The first name of the Student entity entity.'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 60,
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


      $fields['fname'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Father Name'))
      ->setDescription(t('The father name of the Student entity entity.'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 60,
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

    $fields['mname'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Mother Name'))
      ->setDescription(t('The father name of the Student entity entity.'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 60,
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

  $fields['idno'] = BaseFieldDefinition::create('string')
      ->setLabel(t('ID NO'))
      ->setDescription(t('The id of student'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 8,
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

  $fields['sex'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Φυλο'))
      ->setDescription(t('Φυλο'))
      ->setSettings(array(
        'allowed_values' => array(
          'female' => 'female',
          'male' => 'male',
        ),
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'options_select',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

  $fields['birthdate'] = BaseFieldDefinition::create('datetime')
  ->setLabel(t('Ημερομηνία Γέννησης'))
  ->setDescription(t('Ημερομηνία Γέννησης'))
   ->setDisplayOptions('form', array(
          'type' => 'date',
          'weight' => 0,
      ))
      ->setSetting('datetime_type', 'date')
      ->setSetting('timezone_override', '')->setRequired(FALSE);

    $fields['birthplace'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Τόπος Γέννησης'))
      ->setDescription(t('Τόπος Γέννησης'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 100,
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


  $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Student Email'))
      ->setDescription(t('student email'))
    ->setDisplayOptions('view', array(
    'type' => 'email',
  ))
  ->setDisplayOptions('form', [
    'type' => 'email',
    'weight' => 3,
  ])
  ->setRequired(FALSE);

    $fields['telephone'] = BaseFieldDefinition::create('telephone')
      ->setLabel(t('Telephone number'))
      ->setDescription(t('telephone'))
    ->setDisplayOptions('view', array(
        'type' => 'telephone',
     ))
     ->setDisplayOptions('form', [
      'type' => 'telephone',
      'weight' => 3,
    ])
      ->setRequired(FALSE);

    $fields['afm'] = BaseFieldDefinition::create('string')
      ->setLabel(t('ΑΦΜ'))
      ->setDescription(t('ΑΦΜ'))
      ->setRevisionable(TRUE)
      ->setSettings(array(
        'max_length' => 30,
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
      ->setDescription(t('A boolean indicating whether the Student entity is published.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['revision_timestamp'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Revision timestamp'))
      ->setDescription(t('The time that the current revision was created.'))
      ->setQueryable(FALSE)
      ->setRevisionable(TRUE);

    $fields['revision_uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Revision user ID'))
      ->setDescription(t('The user ID of the author of the current revision.'))
      ->setSetting('target_type', 'user')
      ->setQueryable(FALSE)
      ->setRevisionable(TRUE);

    $fields['revision_translation_affected'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Revision translation affected'))
      ->setDescription(t('Indicates if the last edit of a translation belongs to current revision.'))
      ->setReadOnly(TRUE)
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE);

    return $fields;
  }

}
