<?php

namespace Drupal\iek\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the IEK Student entity.
 *
 * @ingroup iek
 *
 * @ContentEntityType(
 *   id = "iek_student",
 *   label = @Translation("IEK Student"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iek\EpalStudentListBuilder",
 *     "views_data" = "Drupal\iek\Entity\EpalStudentViewsData",
 *     "translation" = "Drupal\iek\EpalStudentTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\iek\Form\EpalStudentForm",
 *       "add" = "Drupal\iek\Form\EpalStudentForm",
 *       "edit" = "Drupal\iek\Form\EpalStudentForm",
 *       "delete" = "Drupal\iek\Form\EpalStudentDeleteForm",
 *     },
 *     "access" = "Drupal\iek\EpalStudentAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\iek\EpalStudentHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "iek_student",
 *   data_table = "iek_student_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer iek student entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *     "iekuser_id" = "iekuser_id",
 *     "name" = "name",
 *     "studentsurname" = "studentsurname",
 *   },
 *   links = {
 *     "canonical" = "/admin/iek/iek_student/{iek_student}",
 *     "add-form" = "/admin/iek/iek_student/add",
 *     "edit-form" = "/admin/iek/iek_student/{iek_student}/edit",
 *     "delete-form" = "/admin/iek/iek_student/{iek_student}/delete",
 *     "collection" = "/admin/iek/iek_student",
 *   },
 *   field_ui_base_route = "iek_student.settings"
 * )
 */
class EpalStudent extends ContentEntityBase implements EpalStudentInterface {

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
  public function getUser_id() {
    return $this->get('user_id')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setUser_id($name) {
    $this->set('user_id', $name);
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
  public function getStatus() {
    return $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus($name) {
    $this->set('status', $name);
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
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
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
  public function getEpaluser_id() {
    return $this->get('iekuser_id')->getString();
  }

  /**
   * {@inheritdoc}
   */
  public function setEpaluser_id($name) {
    $this->set('iekuser_id', $name);
    return $this;
  }
  
   /**
   * {@inheritdoc}
   */
  public function getStudentSurname() {
    return $this->get('studentsurname')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStudentSurname($name) {
    $this->set('Studentsurname', $name);
    return $this;
  }

  
  /*
  public function getGuardianFirstname() {
    return $this->get('guardianfirstname')->value;
  }
  
  public function setGuardianFirstname($name) {
    $this->set('guardianfirstname', $name);
    return $this;
  }
  
  public function getGuardianSurname() {
    return $this->get('guardiansurname')->value;
  }

  public function setGuardianSurname($name) {
    $this->set('guardiansurname', $name);
    return $this;
  }
  */

   /**
   * {@inheritdoc}
   */
  public function getStudentAmka() {
    return $this->get('studentamka')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStudentAmka($name) {
    $this->set('studentamka', $name);
    return $this;
  }

   /**
   * {@inheritdoc}
   */
  public function getRegionAddress() {
    return $this->get('regionaddress')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRegionAddress($name) {
    $this->set('regionaddress', $name);
    return $this;
  }

   /**
   * {@inheritdoc}
   */
  public function getRegionTK() {
    return $this->get('regiontk')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRegionTK($name) {
    $this->set('regiontk', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRegionArea() {
    return $this->get('regionarea')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRegionArea($name) {
    $this->set('regionarea', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCertificateType() {
    return $this->get('certificatetype')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCertificateType($name) {
    $this->set('certificatetype', $name);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getCurrentclass() {
    return $this->get('currentclass')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCurrentclass($name) {
    $this->set('currentclass', $name);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getCurrentiek() {
    return $this->get('currentiek')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCurrentiek($name) {
    $this->set('currentiek', $name);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getCurrentsector() {
    return $this->get('currentsector')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCurrentsector($name) {
    $this->set('currentsector', $name);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getTelnum() {
    return $this->get('telnum')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTelnum($name) {
    $this->set('telnum', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRelationToStudent() {
    return $this->get('relationtostudent')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRelationToStudent($name) {
    $this->set('relationtostudent', $name);
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

    $fields['iekuser_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Id ???????????? ????????'))
      ->setDescription(t('???????? ???? id ?????? ?????????????????????? Epal User.'))
      ->setSetting('target_type', 'iek_users')
      ->setSetting('handler', 'default')
	  ->setRequired(true)
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
      ->setLabel(t('?????????? ????????????'))
      ->setDescription(t('???????? ???? ?????????? ????????????.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
	  ->setRequired(true)
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
  
	$fields['studentsurname'] = BaseFieldDefinition::create('string')
          ->setLabel(t('?????????????? ????????????'))
          ->setDescription(t('???????? ???? ?????????????? ????????????.'))
          ->setSettings(array(
            'max_length' => 50,
            'text_processing' => 0,
          ))
		  ->setRequired(true)
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
		  
	  /*
	  $fields['birthdate'] = BaseFieldDefinition::create('datetime')
        ->setLabel(t('???????????????????? ???????????????? ????????????'))
        ->setDescription(t('???????? ?????? ???????????????????? ???????????????? ????????????.'))
        ->setSetting('datetime_type', 'date')
        ->setRequired(false)
        ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => -4,
        ))->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => -4,
        ))
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE);
	  */
	  
	   /*
	   $fields['guardianADT'] = BaseFieldDefinition::create('string')
          ->setLabel(t('?????????????????? ????????????????'))
          ->setDescription(t('???????? ?????? ?????????????????? ????????????????.'))
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
		*/
		
		
	   /* 	  
	   $fields['guardianfirstname'] = BaseFieldDefinition::create('string')
          ->setLabel(t('?????????? ?????? ????????????????'))
          ->setDescription(t('???????? ???? ?????????? ?????? ????????????????.'))
          ->setSettings(array(
            'max_length' => 50,
            'text_processing' => 0,
          ))
		  ->setRequired(true)
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
		  
	    $fields['guardiansurname'] = BaseFieldDefinition::create('string')
          ->setLabel(t('?????????????? ????????????????'))
          ->setDescription(t('???????? ???? ?????????????? ?????? ????????????????.'))
          ->setSettings(array(
            'max_length' => 50,
            'text_processing' => 0,
          ))
		  ->setRequired(true)
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
		*/
		 
	   $fields['studentamka'] = BaseFieldDefinition::create('string')
          ->setLabel(t('???????? ????????????'))
          ->setDescription(t('???????? ???? ???????? ????????????.'))
          ->setSettings(array(
            'max_length' => 20,
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
	  
	   $fields['regionaddress'] = BaseFieldDefinition::create('string')
          ->setLabel(t('???????????????? ????????????????'))
          ->setDescription(t('???????? ???? ?????????????????? ????????????????.'))
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
	  
	  $fields['regiontk'] = BaseFieldDefinition::create('string')
          ->setLabel(t('???? ????????????????'))
          ->setDescription(t('???????? ?????? ???? ?????? ???????????????????? ??????????????????.'))
          ->setSettings(array(
            'max_length' => 10,
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
	  
	  $fields['regionarea'] = BaseFieldDefinition::create('string')
          ->setLabel(t('????????-??????????????????'))
          ->setDescription(t('???????? ?????? ???????? ?? ?????????????????? ?????? ??????????????????.'))
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
		  
	  $fields['regionarea'] = BaseFieldDefinition::create('string')
          ->setLabel(t('????????-??????????????????'))
          ->setDescription(t('???????? ?????? ???????? ?? ?????????????????? ?????? ??????????????????.'))
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
	  	  
	  $fields['certificatetype'] = BaseFieldDefinition::create('string')
          ->setLabel(t('?????????? ??????????????????????'))
          ->setDescription(t('???????? ?????? ???????? ??????????????????????, ???? ???????????????????? ??????????????????'))
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
		  
	  $fields['currentclass'] = BaseFieldDefinition::create('string')
          ->setLabel(t('???????? ????????????????????????????'))
          ->setDescription(t('???????? ?????? ???????????????? ???????? ????????????????????????????'))
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
		  
	  $fields['currentiek'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('???????? ????????????????????????????'))
            ->setDescription(t('???????? ???? ???????????? ???????? ????????????????????????????.'))
            ->setSetting('target_type', 'eiek_school')
            ->setSetting('handler', 'default')
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
		  
	  $fields['currentsector'] = BaseFieldDefinition::create('string')
          ->setLabel(t('???????????? ????????????????????????????'))
          ->setDescription(t('???????? ?????? ?????????? ????????????????????????????.'))
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
		  
	  /*
	  $fields['currentsector'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('???????????? ????????????????????????????'))
            ->setDescription(t('???????? ?????? ?????????? ????????????????????????????.'))
            ->setSetting('target_type', 'eiek_sector')
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
	  */
			
	  $fields['relationtostudent'] = BaseFieldDefinition::create('string')
          ->setLabel(t('?????????? ???????????????? ???? ????????????'))
          ->setDescription(t('???????? ???? ?????????? ???????????????? ???? ????????????, ????  ???????????? - ?????????????????? - ??????????????'))
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

	$fields['telnum'] = BaseFieldDefinition::create('string')
          ->setLabel(t('???????????????? ????????????????????????'))
          ->setDescription(t('???????? ???? ???????????????? ????????????????????????'))
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
		  ->setDescription(t('A boolean indicating whether the IEK Student is published.'))
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
