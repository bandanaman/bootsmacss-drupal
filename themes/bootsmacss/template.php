<?php
/**
 * @file
 * template.php
 *
 * This file should only contain light helper functions and stubs pointing to
 * other files containing more complex functions.
 */

include_once 'bootsmacss.api.php';

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function bootsmacss_preprocess_page(&$variables) {
  // Extending Drupal.settings with pathToTheme object.
  drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "' . path_to_theme() . '" });', 'inline');

  // Check whether given page is configured on Display Suite layout.
  $menu_object = menu_get_object();
  if (module_exists('ds') && !empty($menu_object->type)) {
    $layout = ds_get_layout('node', $menu_object->type, 'full');
  }
  $variables['is_ds_node'] = (!empty($layout)) ? TRUE : FALSE;

  // Layout grid logic.
  if (!$variables['is_ds_node']) {
    if (empty($variables['page']['sidebar_second'])) {
      $variables['content_wrapper_classes'] = 'col-sm-8 col-sm-offset-2';
    }
    else {
      $variables['content_wrapper_classes'] = 'col-sm-8';
    }
  }
  else {
    $variables['theme_hook_suggestions'][] = 'page__ds_node';
  }
}

/**
 * Implements hook_preprocess_node().
 *
 * Enable template suggestions for teaser ex. node--conent-type--teaser.tpl.php.
 */
function bootsmacss_preprocess_node(&$vars) {
  if ($vars['view_mode'] == 'teaser') {
    array_unshift($vars['theme_hook_suggestions'], 'node__' . $vars['node']->type . '__teaser');
    array_unshift($vars['theme_hook_suggestions'], 'node__' . $vars['node']->nid . '__teaser');
  }
}

/**
 * Implements hook_preprocess_block().
 */
function bootsmacss_preprocess_block(&$variables) {
  // Default title declaration.
  $variables['title_tag'] = 'h2';

  // Set h3 tag on titles in specified regions.
  $regions_with_h3 = array(
    'footer_about',
    'footer_quick_links',
  );
  if (in_array($variables['block']->region, $regions_with_h3)) {
    $variables['title_tag'] = 'h3';
  }

  // Hide block titles on specific regions.
  // $regions_without_titles = array('highlight_primary', 'highlight_sidebar');
  // if (in_array($variables['block']->region, $regions_without_titles)) {
  //   $variables['block']->subject = NULL;
  // }

  // Hide titles on all Quicktabs blocks and blocks in navigation regions.
  $regions_without_titles = array('navigation', 'top_nav');
  if (in_array($variables['block']->region, $regions_without_titles) || $variables['block']->module == 'quicktabs') {
    $variables['block']->subject = NULL;
  }

  // Hide block title if it is a views listing block, because listing headers
  // are defined in views inside its structure.
  // @see bootsmacss_preprocess_views_view().
  // Titles in blocks generated by views are used only for exposed filters.
  //
  // Case: If block is views listing block, remove the title.
  if (isset($variables['block']) && $variables['block']->module == 'views' && !strpos($variables['block']->bid, 'exp')) {
    $variables['block']->subject = NULL;
  }
  // Case: If block is exposed filter, use title as label.
  elseif (is_array($variables['block']) && strpos($variables['block']->bid, 'exp') || in_array($variables['block']->module, array('facetapi', 'mefibs'))) {
    $variables['title_tag'] = 'label';
    $variables['classes_array'][] = 'block-exposed';
  }
}

/**
 * Implements hook_preprocess_views_view().
 */
function bootsmacss_preprocess_views_view(&$variables) {
  // If user does not put anything into view header area, set title label from
  // display title. Else leave it empty.
  $view = $variables['view'];
  $display_id = $view->current_display;
  if (isset($view->display[$display_id]->handler->view->display[$display_id]->display_options['title'])) {
    $variables['title'] = $view->display[$display_id]->handler->view->display[$display_id]->display_options['title'];
  }

  // Create a proper HTML structure for the "See more" link.
  // If current display uses "more" links get the ID of display where more link
  // should point at ($more_link_display_id) create more link with l(t()) and
  // add it to the $variables['more'].
  if ($view->display_handler->options['use_more'] == TRUE) {
    if (isset($view->display_handler->options['use_more_text']) && ($view->display_handler->options['use_more_text'] != '') && ($view->display_handler->options['use_more_text'] != NULL)) {
      $more_links_title = $view->display_handler->options['use_more_text'];
    }
    else {
      $more_links_title = "See all";
    }

    $more_link_display_id = $view->display_handler->options['link_display'];
    if ($more_link_display_id != 'custom_url') {
      if (isset($view->display[$more_link_display_id]->handler->options['path'])) {
        $more_link_path = $view->display[$more_link_display_id]->handler->options['path'];
        $more = l(t($more_links_title), $more_link_path, array(
          'html' => TRUE,
          'attributes' => array(
            'class' => array('btn', 'btn-default', 'pull-right'),
            'role' => 'button',
          ),
        ));
      }
      else {
        // If path was not specified in block but "user more link" was selected
        // create anchor-only link (#):
        $more = l(t($more_links_title), NULL, array(
          'external' => TRUE,
          'fragment' => FALSE,
          'attributes' => array(
            'class' => array('btn', 'btn-default', 'pull-right'),
            'role' => 'button',
          ),
        ));
      }
    }
    else {
      $more_link_path = $view->display_handler->options['link_url'];
      $more = l(t($more_links_title), $more_link_path, array(
        'html' => TRUE,
        'attributes' => array(
          'class' => array('btn', 'btn-default', 'pull-right'),
          'role' => 'button',
        ),
      ));
    }

    $variables['more'] = $more;
  }

  // Check if this is a view page.
  $variables['is_page'] = (is_a($variables['view']->display_handler, 'views_plugin_display_page')) ? TRUE : FALSE;
}

/**
 * Implements hook_preprocess_item_list().
 *
 * Override classes of the pager items.
 */
function bootsmacss_preprocess_item_list(&$vars) {
  // Check if this is pagination:
  if (isset($vars['attributes']['class'])) {
    if ($vars['attributes']['class'][0] == 'pagination') {
      if (isset($vars['items']) && !empty($vars['items'])) {
        $items = $vars['items'];
        foreach ($items as $key => $value) {
          if (isset($value['class']) && !empty($value['class'])) {
            if ($value['class'][0] == 'prev') {
              $vars['items'][$key]['class'][0] = 'pager-previous';
              // Get prev page url and override the output:
              $link_path = _find_string_between($value['data'], 'href="', '"');
              if (isset($link_path) && $link_path != NULL && $link_path != '') {
                $vars['items'][$key]['data'] = '<a href="' . $link_path . '"><span class="icon icon--arrow-left"></span></a>';
              }
            }
            if ($value['class'][0] == 'next') {
              $vars['items'][$key]['class'][0] = 'pager-next';
              // Get next page url and override the output:
              $link_path = _find_string_between($value['data'], 'href="', '"');
              if (isset($link_path) && $link_path != NULL && $link_path != '') {
                $vars['items'][$key]['data'] = '<a href="' . $link_path . '"><span class="icon icon--arrow-right"></span></a>';
              }
            }
            if ($value['class'][0] == 'active') {
              $vars['items'][$key]['class'][0] = 'pager-current';
            }
          }
          else {
            $vars['items'][$key]['class'][0] = 'pager-item';
          }
        }
      }
    }
  }
}

/**
 * Implements hook_preprocess_bootstrap_panel().
 */
function bootsmacss_preprocess_bootstrap_panel(&$variables) {
  $variables['attributes']['class'][] = 'well';
}

/**
 * Overrides theme_breadcrumb().
 *
 * Print breadcrumbs in simple-breadcrumb style.
 */
function bootsmacss_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Add necessarry classes first.
    foreach ($breadcrumb as $key => $value) {
      if (is_string($value)) {
        $value = preg_replace('/href/', 'class="simple-breadcrumb__link" href', $value);
        $breadcrumb[$key] = array(
          'data' => $value,
          'class' => array('simple-breadcrumb__item'),
        );
      }
      else {
        $breadcrumb[$key]['class'][] = 'simple-breadcrumb__item';
      }
    }

    // Render breadcrumb array.
    $output = '<h2 class="sr-only">' . t('You are here') . '</h2>';
    $output = theme('item_list', array(
      'attributes' => array(
        'class' => array('simple-breadcrumb'),
      ),
      'items' => $breadcrumb,
      'type' => 'ol',
    ));
    return $output;
  }
}


/**
 * Overrides theme_vertical_tabs().
 *
 * Print verticlal tabs as bootstrap nav.
 */
function bootsmacss_vertical_tabs($variables) {
  $element = $variables['element'];
  // Add required JavaScript and Stylesheet.
  drupal_add_library('system', 'drupal.vertical-tabs');

  $output = '<h2 class="element-invisible">' . t('Vertical Tabs') . '</h2>';
  $output .= '<div class="vertical-tabs-panes">' . $element['#children'] . '</div>';
  return $output;
}

/**
 * Implements hook_theme_registry_alter().
 */
function bootsmacss_theme_registry_alter(&$theme_registry) {
  // Defined path to the current module.
  $path = drupal_get_path('theme', 'bootsmacss');

  // Override field wrappers theming function.
  $theme_registry['field']['theme path'] = $path;
  $theme_registry['field']['function'] = 'bootsmacss_theme_field';
  // Override select widget theme function.
  $theme_registry['select']['theme path'] = $path;
  $theme_registry['select']['function'] = 'bootsmacss_select';
}

/**
 * Implements hook_theme().
 */
function bootsmacss_theme() {
  return array(
    'bootsmacss_social_links' => array(
      'variables' => array(
        'items' => array(),
        'title' => NULL,
      ),
    ),
  );
}

/**
 * Social links theme function.
 */
function theme_bootsmacss_social_links($items, $title) {
  $prefix = $output = $suffix = '';

  // Prefix and suffix for middle centering.
  if (!empty($title)) {
    $prefix = '<div class="middle-align__row">
                <div class="middle-align__col">
                  <p>Follow us at</p>
                </div>
                <div class="middle-align__col">';
    $suffix = '</div></div>';
  }

  // Render links with proper icons.
  foreach ($items as $key => $value) {
    if (strpos($value, 'facebook') !== FALSE) {
      $platform = 'fb';
    }
    elseif (strpos($value, 'twitter') !== FALSE) {
      $platform = 'twitter';
    }
    elseif (strpos($value, 'youtube') !== FALSE) {
      $platform = 'link';
    }
    elseif (strpos($value, 'linkedin') !== FALSE) {
      $platform = 'linkedin';
    }
    else {
      $platform = 'link';
    }
    $items[$key] = array(
      'data' => l('<span class="icon icon--' . $platform . '"></span>', $value, array('html' => TRUE, 'attributes' => array('target' => '_blank'))),
      'class' => array('social-links__item'),
    );
  }

  // Render list.
  $list = theme_item_list(array(
    'title' => '',
    'items' => $items,
    'type' => 'ul',
    'attributes' => array('class' => array('social-links', 'list-inline')),
  ));
  return $prefix . $list . $suffix;
}

/**
 * Implements hook_theme_field().
 *
 * This function works as a Domestos for Drupal fields uncleanliness. We do not
 * want anything like <div class="field-items><div class="field-item odd"> so we
 * delete it. It affects now only field collections.
 */
function bootsmacss_theme_field($variables) {
  $output = '';
  if ($variables['element']['#field_type'] == 'field_collection') {
    foreach ($variables['items'] as $delta => $item) {
      $output .= drupal_render($item);
    }
  }
  else {
    // Render the label, if it's not hidden.
    if (!$variables['label_hidden']) {
      $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
    }

    // Render the items.
    $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
    foreach ($variables['items'] as $delta => $item) {
      $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
      $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
    }
    $output .= '</div>';

    // Render the top-level DIV.
    $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';
  }

  return $output;
}

/**
 * Override file icon function.
 */
function bootsmacss_file_icon($variables) {
  $filemime = check_plain($variables['file']->filemime);
  $iconmime = bootsmacss_icon_mime_class($filemime);
  return '<span class="icon icon--mime-' . $iconmime . '"></span>';
}

/**
 * Returns the mime type in format that is a part of bootsmacss mime icon class.
 */
function bootsmacss_icon_mime_class($filemime) {
  if (strpos($filemime, 'msword') !== FALSE OR strpos($filemime, 'openxmlformats') !== FALSE) {
    return 'doc';
  }
  elseif (strpos($filemime, 'exe') !== FALSE) {
    return 'exe';
  }
  elseif (strpos($filemime, 'jpg') !== FALSE OR strpos($filemime, 'jpeg') !== FALSE) {
    return 'jpg';
  }
  elseif (strpos($filemime, 'pdf') !== FALSE) {
    return 'pdf';
  }
  elseif (strpos($filemime, 'png') !== FALSE) {
    return 'png';
  }
  elseif (strpos($filemime, 'rar') !== FALSE) {
    return 'rar';
  }
  elseif (strpos($filemime, 'ms-excel') !== FALSE) {
    return 'xls';
  }
  elseif (strpos($filemime, 'zip') !== FALSE) {
    return 'zip';
  }
  else {
    return 'default';
  }
}


/**
 * Override select widget theme function to add Bootstrap form-control.
 */
function bootsmacss_select($variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'form-control';
  element_set_attributes($element, array('id', 'name', 'size'));
  _form_set_class($element, array('form-select'));

  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}

/**
 * Overrides theme_menu_local_tasks().
 */
function bootsmacss_menu_local_tasks(&$variables) {
  $output = '';

  // Add .tabs class:
  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs--primary nav nav-pills tabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }

  // Default classes from bootstrap.
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs--secondary pagination pagination-sm">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}

/**
 * Add custom CSS classes to default drupal tabs (primary tabs).
 */
function bootsmacss_menu_local_tasks_alter(&$data, $router_item, $root_path) {
  if (!empty($data['tabs'])) {
    $tabs = $data['tabs'][0]['output'];
    foreach ($tabs as $key => $single_tab) {
      $data['tabs'][0]['output'][$key]['#link']['localized_options']['attributes']['class'][] = 'tabs__tab-link';
    }
  }
}

/**
 * Overrides theme_menu_local_task().
 */
function bootsmacss_menu_local_task(&$variables) {
  $link = $variables['element']['#link'];
  $link_text = $link['title'];
  $classes = array();

  if (!empty($variables['element']['#active'])) {
    // Add text to indicate active tab for non-visual users.
    $active = '<span class="element-invisible">' . t('(active tab)') . '</span>';

    // If the link does not contain HTML already, check_plain() it now.
    // After we set 'html'=TRUE the link will not be sanitized by l().
    if (empty($link['localized_options']['html'])) {
      $link['title'] = check_plain($link['title']);
    }
    $link['localized_options']['html'] = TRUE;
    $link_text = t('!local-task-title!active', array('!local-task-title' => $link['title'], '!active' => $active));

    $classes[] = 'active';
  }
  return '<li class="tabs__tab ' . implode(' ', $classes) . '">' . l($link_text, $link['href'], $link['localized_options']) . "</li>\n";
}

/**
 * Theme function to output tablinks for classic Quicktabs style tabs.
 */
function bootsmacss_qt_quicktabs_tabset($vars) {
  $variables = array(
    'attributes' => array(
      'class' => array(
        'nav',
        'nav-tabs',
        'quicktabs-tabs',
        'quicktabs-style-' . $vars['tabset']['#options']['style'],
        'tabs',
      ),
      'role' => 'tablist',
    ),
    'items' => array(),
  );

  foreach (element_children($vars['tabset']['tablinks']) as $key) {
    $item = array();
    $vars['tabset']['tablinks'][$key]['#options']['attributes']['class'][] = 'tabs__tab-link';
    if (is_array($vars['tabset']['tablinks'][$key])) {
      $tab = $vars['tabset']['tablinks'][$key];
      $item['class'] = array('tabs__tab');
      if ($key == $vars['tabset']['#options']['active']) {
        $item['class'] = array('tabs__tab active');
      }
      $item['data'] = drupal_render($tab);
      $variables['items'][] = $item;
    }
  }
  return '<div class="nav-tabs-wrapper">' . theme('item_list', $variables) . '</div>';
}


/**
 * Utility function for item list.
 */
function _find_string_between($string, $start, $end) {
  $string = " " . $string;
  $ini = strpos($string, $start);
  if ($ini == 0) {
    return "";
  }
  $ini += strlen($start);
  $len = strpos($string, $end, $ini) - $ini;
  return substr($string, $ini, $len);
}
