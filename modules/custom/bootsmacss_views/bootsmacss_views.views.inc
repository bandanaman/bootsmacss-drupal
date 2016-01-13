<?php
/**
 * @file
 * Views implementation.
 */

/**
 * Implements hook_views_plugins().
 */
function bootsmacss_views_views_plugins() {
  $path = drupal_get_path('module', 'bootsmacss_views');

  $plugins = array(
    'style' => array(
      'bootsmacss_bem_listing' => array(
        'title' => t('Bootsmacss BEM listing'),
        'help' => t('Display items using BEM Listing component.'),
        'path' => $path,
        'handler' => 'views_plugin_style_bootsmacss_listing',
        'theme' => 'views_view_bootsmacss_listing',
        'uses row plugin' => TRUE,
        'uses options' => TRUE,
        'uses grouping' => TRUE,
        'type' => 'normal',
      ),
    ),
  );

  return $plugins;
}
