<?php
/**
 * @file
 * template.php
 *
 * This file should only contain light helper functions and stubs pointing to
 * other files containing more complex functions.
 */

 /**
  * Implements hook_preprocess_page().
  *
  * @see page.tpl.php
  */
 function bootsmacss_subtheme_preprocess_page(&$variables) {
  //  // Check whether given page is single page (entity page)
  //  $menu_object = menu_get_object();
  //  $variables['is_singlepage'] = (isset($menu_object->type)) ? TRUE : FALSE;
 }

 /**
 * Implements hook_preprocess_block().
 */
function bootsmacss_subtheme_preprocess_block(&$variables) {
  // // Set h3 tag on titles in specified regions.
  // $regions_with_h3 = array(
  //   'footer_one',
  //   'footer_two',
  //   'footer_three',
  //   'footer_four'
  // );
  // if (in_array($variables['block']->region, $regions_with_h3)) {
  //   $variables['title_tag'] = 'h3';
  // }
  //
  // // Hide block titles on specific regions.
  // $regions_without_titles = array('highlight_primary', 'highlight_sidebar');
  // if (in_array($variables['block']->region, $regions_without_titles)) {
  //   $variables['block']->subject = NULL;
  // }
}
