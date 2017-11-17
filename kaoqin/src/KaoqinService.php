<?php

namespace Drupal\kaoqin;

use Drupal\Core\Database\Connection;

/**
 *
 */
class KaoqinService {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   *
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * Kaoqin entity table save.
   */
  public function saveImportData($datas) {
    foreach ($datas as $data) {
      $kaoqin_entity = \Drupal::entityTypeManager()
        ->getStorage('kaoqin')
        ->create($data);
      $kaoqin_entity->save();
    }
  }

}

