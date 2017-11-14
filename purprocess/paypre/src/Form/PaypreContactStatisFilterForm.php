<?php

namespace Drupal\paypre\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class PaypreContactStatisFilterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'paypre_contact_statis_filter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['filters'] = [
      '#type' => 'details',
      '#title' => '查询条件',
      '#open' => !empty($_SESSION['paypre_contact_statis_filter']),
    ];

    $form['filters']['begin'] = [
      '#type' => 'textfield',
      '#title' => '起始日期',
      '#default_value' => isset($_SESSION['paypre_contact_statis_filter']['begin']) ? $_SESSION['paypre_contact_statis_filter']['begin'] : '',
    ];
    $form['filters']['end'] = [
      '#type' => 'textfield',
      '#title' => '截止日期',
      '#default_value' => isset($_SESSION['paypre_contact_statis_filter']['end']) ? $_SESSION['paypre_contact_statis_filter']['end'] : '',
    ];

    $form['filters']['submit'] = [
      '#type' => 'submit',
      '#value' => '查询',
    ];
    $form['filters']['reset'] = [
      '#type' => 'submit',
      '#value' => '清空',
      '#submit' => ['::resetForm'],
    ];
    $form['#attached'] = [
      'library' => ['paypre/statistic'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $_SESSION['paypre_contact_statis_filter']['begin'] = $form_state->getValue('begin');
    $_SESSION['paypre_contact_statis_filter']['end'] = $form_state->getValue('end');
    $_SESSION['paypre_contact_statis_filter']['status'] = $form_state->getValue('status');
  }

  /**
   * {@inheritdoc}
   */
  public function resetForm(array &$form, FormStateInterface $form_state) {
    $_SESSION['paypre_contact_statis_filter'] = [];
  }

}
