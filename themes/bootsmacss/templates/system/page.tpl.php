<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * Site specific:
 * - $steps_nav (array): Steps navigation
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<div class="side-menu__wrap">
  <!-- Component side-menu -->
  <div class="side-menu">
    <div class="side-menu__scrollbar-hider">
      <h2 class="side-menu__title">
        <span id="close-button" class="side-menu__close icon icon--close"></span>Navigation
      </h2>
      <?php if (!empty($page['side_menu'])): ?>
        <?php print render($page['side_menu']); ?>
      <?php endif; ?>
    </div>
  </div>
  <!-- /Component side-menu -->
  <div id="open-button" class="side-menu__button"><span class="icon icon--menu"></span></div>
  <div class="side-menu__content-wrap">
    <div class="side-menu__content">

    <!-- Section Header -->
    <header class="section-header">
      <div class="container-fluid">

        <div class="header bg bg--6">
          <div class="row">

            <div class="col-xs-6 col-sm-4">

              <!-- Component media-text-row -->
              <div class="media-text-row">
                <div class="media-text-row__row">
                  <div class="media-text-row__media-col">

                    <!-- Component logo -->
                    <a href="<?php print $front_page; ?>" class="media-text-row__media logo side-menu__button-spacer" title="<?php print t('Home'); ?>"></a>
                    <!-- /Component logo -->

                  </div>
                </div>
              </div>
              <!-- /Component media-text-row -->

            </div>

            <div class="col-xs-6 col-sm-8 col-lg-5">

              <!-- Component media-text-row -->
              <div class="media-text-row pull-right">
                <div class="media-text-row__row">
                  <div class="media-text-row__body hidden-xs">
                    <?php if (!empty($page['site_descritpion'])): ?>

                      <!-- Component description-cloud -->
                      <div class="description-cloud description-cloud--corner-radius">
                        <div class="description-cloud__polygon"></div>
                        <div class="description-cloud__content">
                          <?php print render($page['site_descritpion']); ?>
                        </div>
                      </div>
                      <!-- /Component description-cloud -->

                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <!-- /Component media-text-row -->

            </div>

            <div class="col-xs-12 col-lg-3">
              <?php if (!empty($page['user_nav'])): ?>
                <?php print render($page['user_nav']); ?>
              <?php endif; ?>
            </div>

          </div>
        </div>

        <?php if (!empty($page['engagement'])): ?>
          <div class="engagement">
            <?php print render($page['engagement']); ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($steps_nav)): ?>
          <div class="navigation">
            <?php print render($steps_nav); ?>
          </div>
        <?php endif; ?>

      </div>
    </header>
    <!-- /Section Header -->

    <!-- Section Main -->
    <div class="section-main">
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <!-- Component bg -->
      <?php if (!empty($page['highlighted_header']) || !empty($page['highlighted_right']) || !empty($page['highlighted_main'])): ?>
      <div class="bg bg--5">
        <div class="container-fluid bg bg--2">
          <?php if (!empty($page['highlighted_header'])): ?>

            <!-- Component highlight -->
            <div class="highlight">
              <?php print render($page['highlighted_header']); ?>
            </div>
            <!-- /Component highlight -->

          <?php endif; ?>
          <div class="row">
            <div class="col-sm-4 col-sm-push-8">
              <?php if (!empty($page['highlighted_right'])): ?>
                <?php print render($page['highlighted_right']); ?>
              <?php endif; ?>
            </div>
            <div class="col-sm-7 col-sm-pull-4">
              <?php if (!empty($page['highlighted_main'])): ?>
                <?php print render($page['highlighted_main']); ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <!-- /Component bg -->

      <div class="container-fluid">

        <?php print render($title_prefix); ?>
        <?php if (!empty($page['content_header']) && !empty($title)): ?>
          <!-- Component highlight -->
          <div class="highlight visible-xs">
            <h2 class="highlight__text bg bg--5"><strong><?php print $title; ?></strong></h2>
          </div>
          <!-- /Component highlight -->
          <div class="hidden-xs">
            <?php print render($page['content_header']); ?>
          </div>
        <?php elseif (!empty($title) && !$is_front): ?>
          <!-- Component highlight -->
          <div class="highlight">
            <h2 class="highlight__text bg bg--5"><strong><?php print $title; ?></strong></h2>
          </div>
          <!-- /Component highlight -->
        <?php elseif (!empty($page['content_header'])): ?>
          <?php print render($page['content_header']); ?>
        <?php endif; ?>

        <?php print render($title_suffix); ?>

        <div class="row">


          <!-- Section Sidebar first -->
          <?php if (!empty($page['sidebar_first'])): ?>
            <div class="section-sidebar section-sidebar-first col-sm-4">
              <?php print render($page['sidebar_first']); ?>
            </div>
          <?php endif; ?>
          <!-- /Section Sidebar first -->


          <?php if (!empty($page['sidebar_first']) && !empty($page['sidebar_second'])): ?>
            <div class="section-content col-sm-4">
          <?php elseif (!empty($page['sidebar_first'])): ?>
            <div class="section-content col-sm-7 col-sm-offset-1">
          <?php elseif (!empty($page['sidebar_second'])): ?>
            <div class="section-content col-sm-7">
          <?php else: ?>
            <div class="section-content col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <?php endif; ?>
            <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
            <a id="main-content"></a>
            <?php print $messages; ?>
            <?php if (!empty($page['content_pre'])): ?>
              <?php print render($page['content_pre']); ?>
            <?php endif; ?>
            <?php if (!empty($tabs)): ?>
              <?php print render($tabs); ?>
            <?php endif; ?>
            <?php if (!empty($action_links)): ?>
              <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>
            <?php print render($page['content']); ?>
          </div>

          <!-- Section Sidebar second -->
          <?php if (!empty($page['sidebar_second'])): ?>
            <div class="section-sidebar section-sidebar-second col-sm-4 col-sm-offset-1<?php if ($is_front): ?> hidden-xs <?php endif; ?>">
              <?php print render($page['sidebar_second']); ?>
            </div>
          <?php endif; ?>
          <!-- /Section Sidebar second -->

        </div>
      </div>
    </div>
    <!-- /Section Main -->

    <!-- Component bg -->
    <div class="bg bg--3">
      <div class="container-fluid">
        <?php if (!empty($page['about'])): ?>

          <!-- Component media-text-row -->
          <div class="media-text-row media-text-row--paddings">
            <div class="media-text-row__row">
              <div class="media-text-row__media-col hidden-xs hidden-sm">
                <!-- Component logo -->
                <div class="media-text-row__media logo" style="width: 270px; height: 69px"></div>
                <!-- /Component logo -->
              </div>
              <div class="media-text-row__body">
                  <?php print render($page['about']); ?>
              </div>
            </div>
          </div>
          <!-- /Component media-text-row -->

        <?php endif; ?>
      </div>

      <!-- Component footer -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <?php if (!empty($page['footer_social'])): ?>
              <?php if (!empty($page['footer_subscribe'])): ?>
                <div class="col-xs-4 col-md-3 col-lg-2 col-lg-push-5">
              <?php else: ?>
                <div class="col-xs-12 col-md-3 col-md-push-9 col-lg-2 col-lg-push-10">
              <?php endif; ?>
                <?php print render($page['footer_social']); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($page['footer_subscribe'])): ?>
              <div class="col-xs-8 col-md-9 col-lg-5 col-lg-push-5">
                <?php print render($page['footer_subscribe']); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($page['footer_nav'])): ?>

              <?php if (!empty($page['footer_subscribe'])): ?>
                <div class="col-xs-12 col-lg-5 col-lg-pull-7">
              <?php else: ?>

                <nav class="col-xs-12 col-md-9 col-md-pull-3 col-lg-pull-2">
              <?php endif; ?>
                <?php print render($page['footer_nav']); ?>
                </nav>

            <?php endif; ?>
          </div>
        </div>
      </footer>
      <!-- /Component footer -->

    </div>
    <!-- /Component bg -->
  </div>
</div>
