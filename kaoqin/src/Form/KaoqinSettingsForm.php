<?php

namespace Drupal\kaoqin\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\Component\Utility\SafeMarkup;
/**
 *
 */
class KaoqinSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'kaoqin_settings_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#markup' => SafeMarkup::format("<font color=red>班次排班时，请勿重复排班。该考勤部门不包括总监级考勤.</font>",[]),
    ];

    $departs_tids = [18, 19, 20, 21, 22, 40, 41, 83];
    $term_departs = Term::loadMultiple($departs_tids);

    $options_depart = [];
    foreach ($term_departs as $key => $term_depart) {
      $options_depart[$key] = taxonomy_term_title($term_depart);
    }
    $form['filters_normal'] = [
      '#type' => 'details',
      '#title' => '正常班次',
      '#open' => True,
    ];
    $form['filters_normal']['departs_normal'] = [
      '#type' => 'select',
      '#title' => '正常排班部门',
      '#options' => $options_depart,
      '#multiple' => 1,
      '#size' => min(12, count($options_depart)),
      '#description' => '正常排班的部门有哪些，请指定。',
    ];
    $form['filters_normal']['description'] = [
      '#markup' => '正常班次考勤时间在9:05~18:00之间',
    ];
    $form['filters_tanxing'] = array(
      '#type' => 'details',
      '#title' => '弹性工作时间',
      '#open' => True,
    );

    $form['filters_tanxing']['departs_tanxing'] = [
      '#type' => 'select',
      '#title' => '弹性工作部门',
      '#options' => $options_depart,
      '#multiple' => 1,
      '#size' => min(12, count($options_depart)),
      '#description' => '弹性工作的部门有哪些，请指定。',
    ];

    $form['filters_tanxing']['description'] = [
      '#markup' => '弹性工作时间考勤时间必须在10:00~17:00,上班总时间不小于9小时',
    ];

    $form['filters_paiban'] = array(
      '#type' => 'details',
      '#title' => '排班班次',
      '#open' => True,
    );

    $form['filters_paiban']['departs_paiban'] = [
      '#type' => 'select',
      '#title' => '排班工作部门',
      '#options' => $options_depart,
      '#multiple' => 1,
      '#size' => min(12, count($options_depart)),
      '#description' => '排班工作的部门有哪些，请指定。',
    ];

    $form['filters_paiban']['description'] = [
      '#markup' => '上班时间不固定，纯手工排班',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}cornsilk
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    drupal_set_message('考勤单保存成功');
  }

}
