<?php

namespace Drupal\eiek\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the School entity entity.
 *
 * @ingroup eiek
 *
 * @ContentEntityType(
 *   id = "school_entity",
 *   label = @Translation("School entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\eiek\SchoolEntityListBuilder",
 *     "views_data" = "Drupal\eiek\Entity\SchoolEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\eiek\Form\SchoolEntityForm",
 *       "add" = "Drupal\eiek\Form\SchoolEntityForm",
 *       "edit" = "Drupal\eiek\Form\SchoolEntityForm",
 *       "delete" = "Drupal\eiek\Form\SchoolEntityDeleteForm",
 *     },
 *     "access" = "Drupal\eiek\SchoolEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\eiek\SchoolEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "school_entity",
 *   admin_permission = "administer school entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "iekcode" = "iekcode",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/school_entity/{school_entity}",
 *     "add-form" = "/admin/structure/school_entity/add",
 *     "edit-form" = "/admin/structure/school_entity/{school_entity}/edit",
 *     "delete-form" = "/admin/structure/school_entity/{school_entity}/delete",
 *     "collection" = "/admin/structure/school_entity",
 *   },
 *   field_ui_base_route = "school_entity.settings"
 * )
 */
class SchoolEntity extends ContentEntityBase implements SchoolEntityInterface {

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
  public function getIekcode() {
    return $this->get('iek_code')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setIekcode($iekcode) {
    $this->set('iekcode', $iekcode);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function getRegion_id() {
    return $this->get('region_id')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRegion_id($region_id) {
    $this->set('region_id', $region_id);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function getIektype() {
    return $this->get('iektype')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setIektype($iektype) {
    $this->set('iektype', $iektype);
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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the School entity entity.'))
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
      ->setDescription(t('The name of the School entity entity.'))
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

    $fields['iekcode'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Κωδικός ΙΕΚ'))
      ->setDescription(t('Κωδικός ΙΕΚ'))
      ->setSettings(array(
        'max_length' => 7,
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

    $fields['region_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Περιοχή που ανήκει το ΙΕΚ'))
      ->setDescription(t('Περιοχή που ανήκει το ΙΕΚ'))
      ->setSetting('target_type', 'region_entity')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

     $fields['iektype'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Τυπος ΙΕΚ'))
      ->setDescription(t('Τυπος ΙΕΚ Δημόσιο ή Ιδιωτικό'))
      ->setSettings(array(
        'allowed_values' => array(
          'public' => 'public',
          'private' => 'private',
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

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the School entity is published.'))
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
