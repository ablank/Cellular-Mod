<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\ContactBlock.
 */

namespace Drupal\article\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'contact' block.
 *
 * @Block(
 *   id = "contact_block",
 *   admin_label = @Translation("Contact Us"),
 *   category = @Translation("Custom contact us block")
 * )
 */
class ContactBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();

    // Add a form field to the existing block configuration form.
    $form['org_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Organization:'),
      '#default_value' => isset($config['org_name'])? $config['org_name'] : '',
    );
    $form['org_loc'] = array(
      '#type' => 'textfield',
      '#title' => t('Location:'),
      '#default_value' => isset($config['org_loc'])? $config['org_loc'] : '',
    );
    $form['org_email'] = array(
      '#type' => 'email',
      '#title'=> t('Email ID:'),
      '#default_value' => isset($config['org_email'])? $config['org_email'] : '',
    );
    $form['org_phone'] = array(
      '#type' => 'number',
      '#title'=> t('Contact:'),
      '#default_value' => isset($config['org_phone'])? $config['org_phone'] : '',
    );
    $form['org_addr'] = array(
      '#type' => 'textfield',
      '#title'=> t('Address:'),
      '#default_value' => isset($config['org_addr'])? $config['org_addr'] : '',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('org_name', $form_state->getValue('org_name'));
    $this->setConfigurationValue('org_loc', $form_state->getValue('org_loc'));
    $this->setConfigurationValue('org_email', $form_state->getValue('org_email'));
    $this->setConfigurationValue('org_phone', $form_state->getValue('org_phone'));
    $this->setConfigurationValue('org_addr', $form_state->getValue('org_addr'));
  }



  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $org_name = isset($config['org_name']) ? $config['org_name'] : '';
    $org_loc = isset($config['org_loc']) ? $config['org_loc'] : '';
    $org_email = isset($config['org_email']) ? $config['org_email'] : '';
    $org_phone = isset($config['org_phone']) ? $config['org_phone'] : '';
    $org_addr = isset($config['org_addr']) ? $config['org_addr'] : '';

    return array(
      '#markup' => $this->t('@org, @loc. Email id : @mail Phn: @phn. Address: @add', array('@add'=> $org_addr,'@phn'=> $org_phone,'@mail'=> $org_email,'@org'=> $org_name,'@loc' => $org_loc)),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    $org_name = $form_state->getValue('org_name');

    if (is_numeric($org_name)) {
      drupal_set_message('needs to be an integer', 'error');
      $form_state->setErrorByName('org_name', t('Organization name should not be numeric'));
    }
  }
}
