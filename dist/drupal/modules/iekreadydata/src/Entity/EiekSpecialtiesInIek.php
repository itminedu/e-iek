<?php

namespace Drupal\iekreadydata\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Eiek specialties in iek entity.
 *
 * @ingroup iekreadydata
 *
 * @ContentEntityType(
 *   id = "eiek_specialties_in_iek",
 *   label = @Translation("Eiek specialties in iek"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iekreadydata\EiekSpecialtiesInEpalListBuilder",
 *     "views_data" = "Drupal\iekreadydata\Entity\EiekSpecialtiesInEpalViewsData",
 *     "translation" = "Drupal\iekreadydata\EiekSpecialtiesInEpalTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\iekreadydata\Form\EiekSpecialtiesInEpalForm",
 *       "add" = "Drupal\iekreadydata\Form\EiekSpecialtiesInEpalForm",
 *       "edit" = "Drupal\iekreadydata\Form\EiekSpecialtiesInEpalForm",
 *       "delete" = "Drupal\iekreadydata\Form\EiekSpecialtiesInEpalDeleteForm",
 *     },
 *     "access" = "Drupal\iekreadydata\EiekSpecialtiesInEpalAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\iekreadydata\EiekSpecialtiesInEpalHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "eiek_specialties_in_iek",
 *   data_table = "eiek_specialties_in_iek_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer eiek specialties in iek entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/eiek_specialties_in_iek/{eiek_specialties_in_iek}",
 *     "add-form" = "/admin/structure/eiek_specialties_in_iek/add",
 *     "edit-form" = "/admin/structure/eiek_specialties_in_iek/{eiek_specialties_in_iek}/edit",
 *     "delete-form" = "/admin/structure/eiek_specialties_in_iek/{eiek_specialties_in_iek}/delete",
 *     "collection" = "/admin/structure/eiek_specialties_in_iek",
 *   },
 *   field_ui_base_route = "eiek_specialties_in_iek.settings"
 * )
 */
class EiekSpecialtiesInEpal extends ContentEntityBase implements EiekSpecialtiesInEpalInterface {

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Eiek specialties in iek entity.'))
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
      ->setDescription(t('The name of the Eiek specialties in iek entity.'))
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

    $fields['iek_id'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('?????????????? ????????????????'))
        ->setDescription(t('?????????????? ????????????????.'))
        ->setSetting('target_type', 'eiek_school')
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
	
	$fields['specialty_id'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('???????????????????? ????????????????'))
        ->setDescription(t('???????????????????? ????????????????.'))
        ->setSetting('target_type', 'eiek_specialty')
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
	
	$fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Eiek specialties in iek is published.'))
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
