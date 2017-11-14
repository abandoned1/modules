<?php

namespace Drupal\hksample\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityStorageInterface;

/**
 * Defines the hksample entity class.
 *
 * @ContentEntityType(
 *   id = "hksample",
 *   label = @Translation("通用模型"),
 *   base_table = "hksample",
 *   handlers = {
 *     "list_builder" = "Drupal\hksample\HksampleListBuilder",
 *     "access" = "Drupal\hksample\HksampleAccessControlHandler",
 *     "form" = {
 *       "default" = "Drupal\hksample\Form\HksampleForm"
 *     }
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "no",
 *     "uuid"  = "uuid",
 *   },
 *   links = {
 *     "edit-form" = "/admin/hksample/{hksample}/edit",
 *   }
 * )
 */
class Hksample extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);
    $this->set('uid', \Drupal::currentUser()->id());
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Hksample ID'))
      ->setDescription(t('The Hksample ID.'))
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The Hksample UUID for updated.'))
      ->setReadOnly(TRUE);

    // 可识别编号.
    $fields['no'] = BaseFieldDefinition::create('string')
      ->setLabel(t('No.'))
      ->setDescription(t('No.'));

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('申请人'))
      ->setSetting('target_type', 'user');

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The hksample was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The hksample was last edited..'));

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code.'));

    return $fields;
  }

}
