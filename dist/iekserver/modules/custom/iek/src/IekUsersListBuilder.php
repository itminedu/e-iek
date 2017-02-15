<?php

namespace Drupal\iek;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Epal users entities.
 *
 * @ingroup iek
 */
class EpalUsersListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
	$header['name'] = $this->t('??????????');
	$header['surname'] = $this->t('??????????????');
	$header['fathername'] = $this->t('?????????? ????????????');
	$header['mothername'] = $this->t('?????????? ??????????????');
	
	//$header['drupaluser_id'] = $this->t('ID ???????????? Drupal');
	//$header['taxis_userid'] = $this->t('ID ???????????? ?????? taxisnet');
	//$header['taxis_taxid'] = $this->t('TAXID ???????????? ?????? taxisnet');
	//$header['address'] = $this->t('??????????????????');
	//$header['addresstk'] = $this->t('????');
	//$header['addressarea'] = $this->t('??????????????');
	//$header['accesstoken'] = $this->t('AccessToken');
	//$header['authtoken'] = $this->t('AuthToken');
	//$header['timelogin'] = $this->t('Time Login');
	//$header['timeregistration'] = $this->t('Time Registration');
	//$header['timetokeninvalid'] = $this->t('Time Token Invalid');
	//$header['userip'] = $this->t('User IP');
    
	return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\iek\Entity\EpalUsers */
	 $row['id'] = $entity->id();
	 $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.iek_users.edit_form', array(
          'iek_users' => $entity->id(),
        )
      )
    );
	$row['surname'] = $this->l(
	  $entity->getSurname(),
	  new Url(
        'entity.iek_users.edit_form', array(
          'iek_users' => $entity->id(),
        )
      )   
    );
	$row['fathername'] = $this->l(
	  $entity->getFathername(),
	  new Url(
        'entity.iek_users.edit_form', array(
          'iek_users' => $entity->id(),
        )
      )
    );
	$row['mothername'] = $this->l(
	  $entity->getMothername(),
	  new Url(
        'entity.iek_users.edit_form', array(
          'iek_users' => $entity->id(),
        )
      )
    );
	
    return $row + parent::buildRow($entity);
  }

}
