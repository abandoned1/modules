<?php

namespace Drupal\kaoqin\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class KaoqinController extends ControllerBase {

  /**
   * @description 考勤数据导入.
   */
  public function getImportKaoqin() {

    $build = ['#markup' => 'fdafd'];
    return $build;
  }

  /**
   * @description 模板导出.
   */
  public function exportKaoqin(){
    $filename=realpath('sites/default/files/kaoqin.xlsx'); //文件名
    $date=date("Ymd-H:i:m");
    Header( "Content-type:  application/octet-stream ");
    Header( "Accept-Ranges:  bytes ");
    Header( "Accept-Length: " .filesize($filename));
    header( "Content-Disposition:  attachment;  filename= {$date}.xlsx");
    readfile($filename);
    return new Response('ok');
  }

}