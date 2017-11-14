<?php

namespace Drupal\purchase\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class PurchaseForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $form['no'] = [
      '#type' => 'textfield',
      '#title' => '采购单编号',
      '#default_value' => $this->entity->get('no')->value,
      '#description' => '该编号结构为C+9位数字',
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
   * Overrides Drupal\Core\Entity\EntityForm::submit().
   */
  public function save(array $form, FormStateInterface $form_state) {
    $this->entity->set('no', $form_state->getValue('no'))
      ->save();
    drupal_set_message('采购单保存成功');
  }

}
