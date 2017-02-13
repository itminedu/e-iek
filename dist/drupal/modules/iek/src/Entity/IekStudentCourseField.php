<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Epal student course field entity.
 *
 * @ingroup iek
 *
 * @ContentEntityType(
 *   id = "iek_student_course_field",
 *   label = @Translation("Epal student course field"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iek\EpalStudentCourseFieldListBuilder",
 *     "views_data" = "Drupal\iek\Entity\EpalStudentCourseFieldViewsData",
 *     "translation" = "Drupal\iek\EpalStudentCourseFieldTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\iek\Form\EpalStudentCourseFieldForm",
 *       "add" = "Drupal\iek\Form\EpalStudentCourseFieldForm",
 *       "edit" = "Drupal\iek\Form\EpalStudentCourseFieldForm",
 *       "delete" = "Drupal\iek\Form\EpalStudentCourseFieldDeleteForm",
 *     },
 *     "access" = "Drupal\iek\EpalStudentCourseFieldAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\iek\EpalStudentCourseFieldHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "iek_student_course_field",
 *   data_table = "iek_student_course_field_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer iek student course field entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *     "student_id" = "student_id",
 *     "courseField_id" = "courseField_id",  
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/iek_student_course_field/{iek_student_course_field}",
 *     "add-form" = "/admin/structure/iek_student_course_field/add",
 *     "edit-form" = "/admin/structure/iek_student_course_field/{iek_student_course_field}/edit",
 *     "delete-form" = "/admin/structure/iek_student_course_field/{iek_student_course_field}/delete",
 *     "collection" = "/admin/structure/iek_student_course_field",
 *   },
 *   field_ui_base_route = "iek_student_course_field.settings"
 * )
 */
class EpalStudentCourseField extends ContentEntityBase implements EpalStudentCourseFieldInterface {

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
  public function getCourseField_id() {
    return $this->get('courseField_id')->getString();
  }

  /**
   * {@inheritdoc}
   */
  public function setCourseField_id($name) {
    $this->set('courseField_id', $name);
    return $this;
  }

/**
   * {@inheritdoc}
   */
  public function getStudent_id() {
    return $this->get('student_id')->getString();
  }

  /**
   * {@inheritdoc}
   */
  public function setStudent_id($name) {
    $this->set('student_id', $name);
    return $this;
  }

 

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('????????????????????'))
      ->setDescription(t('????????????????????.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'above',
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
      ->setLabel(t('??????????'))
      ->setDescription(t('??????????.'))
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
	  
	$fields['student_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('ID ????????????'))
      ->setDescription(t('???????? ???? id ????????????.'))
      ->setSetting('target_type', 'iek_student')
            ->setSetting('handler', 'default')
            ->setTranslatable(TRUE)
            ->setDisplayOptions('view', array(
              'label' => 'above',
              'type' => 'author',
              'weight' => -4,
            ))
	 ->setRequired(true)
           ->setDisplayOptions('form', array(
              'type' => 'entity_reference_autocomplete',
              'weight' => -4,
              'settings' => array(
                'match_operator' => 'CONTAINS',
                'size' => '60',
                'autocomplete_type' => 'tags',
                'placeholder' => '',
              ),
            ))
     ->setDisplayConfigurable('form', TRUE)
     ->setDisplayConfigurable('view', TRUE);
	
	
	 $fields['courseField_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('ID ??????????????????????'))
            ->setDescription(t('???????? ???? id ?????????????????????? ?????? ?????????????? ?? ??????????????.'))
            ->setSetting('target_type', 'eiek_specialty')
            ->setSetting('handler', 'default')
			->setRequired(true)
            ->setTranslatable(TRUE)
            ->setDisplayOptions('view', array(
              'label' => 'above',
              'type' => 'author',
              'weight' => -4,
            ))
            ->setDisplayOptions('form', array(
              'type' => 'entity_reference_autocomplete',
              'weight' => -4,
              'settings' => array(
                'match_operator' => 'CONTAINS',
                'size' => '60',
                'autocomplete_type' => 'tags',
                'placeholder' => '',
              ),
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Epal student course field is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
