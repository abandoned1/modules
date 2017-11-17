<?php

namespace Drupal\kaoqin;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Defines a class to build a listing of kaoqin entities.
 *
 * @see \Drupal\kaoqin\Entity\Kaoqin
 */
class KaoqinListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function load() {
    $entity_query = $this->storage->getQuery();
    $entity_query->condition('id', 0, '<>');
    $entity_query->pager(20);
    $header = $this->buildHeader();
    $entity_query->tableSort($header);
    $ids = $entity_query->execute();

    return $this->storage->loadMultiple($ids);
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = [
      'id' => [
        'data' => $this->t('ID'),
        'field' => 'id',
        'specifier' => 'id',
      ],

      'code' => [
        'data' => $this->t('人员编号'),
        'field' => 'code',
        'specifier' => 'code',
      ],
      'emname' => [
        'data' => $this->t('姓名'),
        'field' => 'emname',
        'specifier' => 'emname',
      ],
      'logdate' => [
        'data' => $this->t('考勤日期'),
        'field' => 'logdate',
        'specifier' => 'logdate',
      ],
      'weekday' => [
        'data' => $this->t('星期'),
        'field' => 'weekday',
        'specifier' => 'weekday',
      ],
      'banci' => [
        'data' => $this->t('班次'),
        'field' => 'banci',
        'specifier' => 'banci',
      ],
      'morningsign' => [
        'data' => $this->t('上班'),
        'field' => 'morningsign',
        'specifier' => 'morningsign',
      ],
      'afternoonsign' => [
        'data' => $this->t('下班'),
        'field' => 'afternoonsign',
        'specifier' => 'afternoonsign',
      ],
      'uid' => [
        'data' => $this->t('创建人'),
        'field' => 'uid',
        'specifier' => 'uid',
      ],
      'created' => [
        'data' => $this->t('创建时间'),
        'field' => 'created',
        'specifier' => 'created',
      ],
    ];

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['code'] = $entity->get('code')->value;
    $row['emname'] = $entity->get('emname')->value;
    $row['logdate'] = date('Y-m-d', $entity->get('logdate')->value);
    $row['weekday'] = $entity->get('weekday')->value;
    $row['banci'] = $entity->get('banci')->value;
    $row['morningsign'] = date('H:i', $entity->get('morningsign')->value);
    $row['afternoonsign'] = date('H:i', $entity->get('afternoonsign')->value);
    $row['uid'] = $entity->get('uid')->entity->getUsername();
    $row['created'] = date('Y-m-d H:i', $entity->get('created')->value);

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations(EntityInterface $entity) {
    $operations = parent::getOperations($entity);

    if (isset($operations['edit'])) {
      $operations['edit'] = [
        'title' => $this->t('Edit'),
        'weight' => 10,
        'url' => $entity->urlInfo('edit-form'),
      ];
    }

    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();
    $build['table']['#empty'] = $this->t('没有可用的数据.');

    return $build;
  }

}
