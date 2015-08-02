<?php

/**
 * @file
 * Hooks provided by the BootSMACSS base theme.
 *
 * This file contains example theme functions for menus to render them with
 * valid HTML markup corresponding to given component.
 *
 * Place all theming code for components here!
 *
 *
 * EXAMPLE USAGE - THEMING USER MENU:
 * function bootsmacss_menu_tree__user_menu(&$variables) {
 *   return bootsmacss_nav_icons_theming($variables);
 * }
 * function bootsmacss_user_menu_link_theming(&$variables) {
 *   return bootsmacss_nav_icons_link_theming($variables);
 * }
 */

/**
 * Vertical navigation (nav-vertical) menu reusable theming function.
 */
function bootsmacss_nav_vertical_theming(&$variables) {
  return '<ul class="nav-vertical">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Vertical navigation (nav-vertical) menu link reusable theming function.
 */
function bootsmacss_nav_vertical_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'nav-vertical__item';
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $element['#localized_options']['attributes']['class'] = array('nav-vertical__link');
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Navigation tiles (nav-tiles) menu reusable theming function.
 */
function bootsmacss_nav_tiles_theming(&$variables) {
  return '<ul class="nav-tiles nav-tiles--gradient">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Navigation tiles (nav-tiles) menu links reusable theming function.
 */
function bootsmacss_nav_tiles_link_theming(&$variables) {
  $element = $variables['element'];

  $sub_menu = '';
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  // Add web component elements classes.
  $element['#attributes']['class'][] = 'nav-tiles__item';
  $element['#localized_options']['attributes']['class'] = array('nav-tiles__link');

  // Link description serves as icon type class.
  $icon = $element['#localized_options']['attributes']['title'];
  unset($element['#localized_options']['attributes']['title']);

  // Allways allow html markup in link, because we use it below.
  $element['#localized_options']['html'] = 1;

  $markup = '<div class="nav-tiles__icon-collumn">
              <div class="nav-tiles__icon-wrapper">
                <span class="icon ' . $icon . '"></span>
              </div>
            </div>
            <div class="nav-tiles__label-collumn">
              <div class="nav-tiles__label">' . $element['#title'] . '</div>
            </div>';

  $output = l($markup, $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Navigation with icons (nav-icons) menu reusable theming function.
 */
function bootsmacss_nav_icons_theming(&$variables) {
  return '<ul class="nav-icons list-inline pull-right">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Navigation with icons (nav-icons) menu links reusable theming function.
 */
function bootsmacss_nav_icons_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'nav-icons__item';
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $element['#localized_options']['attributes']['class'] = array('nav-icons__link');
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Footer navigation (nav-footer) menu reusable theming function.
 */
function bootsmacss_nav_footer_theming(&$variables) {
  return '<ul class="nav-footer list-inline">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Footer navigation (nav-footer) menu reusable theming function.
 */
function bootsmacss_nav_footer_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'nav-footer__item';
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $element['#localized_options']['attributes']['class'] = array('nav-footer__link');
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Blocktitle navigation (nav-blocktitle) reusable theming function.
 */
function bootsmacss_nav_blocktitle_theming(&$variables) {
  return '<ul class="nav-blocktitle pull-right">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Blocktitle navigation (nav-blocktitle) link reusable theming function.
 */
function bootsmacss_nav_blocktitle_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'nav-blocktitle__item';
  $sub_menu = '';
  $prefix = '';
  $suffix = '';

  if ($element['#below']) {
    $prefix = '<div class="dropdown">';
    $suffix = '</div>';
    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['id'] = $element['#below']['#id'] = 'dropdownMenu' . $element['#original_link']['mlid'];
    $element['#localized_options']['attributes']['data-toggle'][] = 'dropdown';
    $element['#localized_options']['attributes']['data-haspopup'][] = 'true';
    $element['#localized_options']['attributes']['data-expanded'][] = 'true';
    $element['#localized_options']['html'] = TRUE;
    unset($element['#below']['#theme_wrappers']);
    $sub_menu = '<ul class="dropdown-menu" aria-labelledby=' . $element['#below']['#id'] . '">' . drupal_render($element['#below']) . '</ul>';
    $element['#title'] = $element['#title'] . '<span class="icon icon--arrow-next pull-right"></span>';
  }
  $element['#localized_options']['attributes']['class'] = array('nav-blocktitle__link');
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $prefix . $output . $sub_menu . $suffix . "</li>\n";
}

/**
 * Horizontal navigation (nav-horizontal) reusable theming function.
 */
function bootsmacss_nav_horizontal_theming(&$variables) {
  return '<ul class="nav-horizontal nav-horizontal--condensed list-inline pull-right">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Horizontal navigation (nav-horizontal) link reusable theming function.
 */
function bootsmacss_nav_horizontal_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'nav-horizontal__item';
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $element['#localized_options']['attributes']['class'] = array('nav-horizontal__link');
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Metro navigation (nav-metro) reusable theming function.
 */
function bootsmacss_nav_metro_theming(&$variables) {
  return '<ul class="nav-metro">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Metro navigation (nav-metro) link reusable theming function.
 */
function bootsmacss_nav_metro_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'nav-metro__item';
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $element['#localized_options']['attributes']['class'] = array('nav-metro__link');
  $station = '<div class="nav-metro__station"></div>';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $station . $output . $sub_menu . "</li>\n";
}

/**
 * Arrowbox navigation (nav-arrowbox) menu reusable theming function.
 */
function bootsmacss_nav_arrowbox_theming(&$variables) {
  return '<ul class="nav-arrowbox">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Navigation tiles (nav-tiles) menu links reusable theming function.
 */
function bootsmacss_nav_arrowbox_link_theming(&$variables) {
  $element = $variables['element'];

  $sub_menu = '';
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  // Add web component elements classes.
  $element['#attributes']['class'][] = 'nav-arrowbox__item';
  $element['#localized_options']['attributes']['class'] = array('nav-arrowbox__link');
  $icon = $element['#icon'];
  // Allways allow html markup in link, because we use it below.
  $element['#localized_options']['html'] = 1;

  $markup = '<div class="nav-arrowbox__icon">
              <span class="icon icon--' . $icon . '"></span>
            </div>
            <div class="nav-arrowbox__label">' . $element['#title'] . '</div>
            <div class="nav-arrowbox__bg">
              <span class="icon icon--arrow-next"></span>
            </div>';

  $output = l($markup, $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Sidebar menu item (side-menu) menu reusable theming function.
 */
function bootsmacss_side_menu_theming(&$variables) {
  return '<ul class="side-menu_nav">' .
    $variables['tree'] .
  '</ul>';
}

/**
 * Sidebar menu item (side-menu) menu links reusable theming function.
 */
function bootsmacss_side_menu_link_theming(&$variables) {
  $element = $variables['element'];
  $element['#attributes']['class'][] = 'side-menu_nav-item';
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $element['#localized_options']['attributes']['class'] = array('side-menu_nav-link');
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
