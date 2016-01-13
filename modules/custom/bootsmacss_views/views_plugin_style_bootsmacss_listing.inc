<?php
/**
 * @file
 * Settings placeholder.
 */

/**
 * Class to define a style plugin handler.
 */
class views_plugin_style_bootsmacss_listing extends views_plugin_style {
  /**
   * Definition.
   */
  public function option_definition() {
    $options = parent::option_definition();
    $options['listing_modifier'] = array('default' => NULL);
    $options['listing_modifier_extra'] = array('default' => NULL);
    $options['listing_columns'] = array('default' => NULL);
    return $options;
  }

  /**
   * Form.
   */
  public function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['listing_modifier'] = array(
      '#type' => 'select',
      '#title' => t('BEM: Listing Modifier'),
      '#options' => array(
        'default' => t('Default'),
        'condensed' => t('Condensed'),
        'zebra' => t('Zebra'),
        'no_separators' => t('No Separators'),
        'separators_dashed ' => t('Separators Dashed'),
        'column_second_above' => t('Column Second Above'),
        'row_two' => t('Row with two items'),
        'row_three' => t('Row with three items'),
      ),
      '#default_value' => $this->options['listing_modifier'],
    );

    $form['listing_modifier_extra'] = array(
      '#type' => 'textfield',
      '#title' => t('BEM: Listing Modifier Extra'),
      '#default_value' => $this->options['listing_modifier_extra'],
      '#description' => t('Class names separated by spaces.'),
    );

    $form['listing_columns'] = array(
      '#type' => 'select',
      '#title' => t('BEM: Listing Layout'),
      '#options' => array(
        'default' => t('Default'),
        'two_columns' => t('Two Columns'),
        'three_columns' => t('Three Columns'),
      ),
      '#default_value' => $this->options['listing_columns'],
    );
  }

}
