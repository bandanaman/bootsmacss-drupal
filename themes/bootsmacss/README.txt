//
// DESCRIPTION
//

BootSMACSS base theme holds files and hooks related to BootSMACSS Styleguide
based on Web Components theming approach (http://webcomponents.org). It is a
bridge between custom themes based on BootSMACSS components styleguide and
Bootstrap base theme, because BootSMACSS styleguide is based on Bootstrap
framework.
It can be visualised the following way:

Drupal
|- bootstrap - base theme from drupal.org
 |- bootsmacss - theme from BootSMACSS repository
  |- bootsmacss_subtheme  -customizable starter theme

Only bootsmacss_subtheme should be forked and modified. Anything else is for
cross-project purposes. If there is any need to change something inside bootsmacss
theme, it could be changed also inside independent WAAT git repository.

This theme works well with dedicated waat_layouts, waat_formatters and other
modules where you can find custom Display Suite layouts, view modes, field
formatters, etc. See particular module's README file for reference.



//
// USAGE TUTORIAL FOR NEW SITE
//

1. To create a theme for new site, copy BOOTSMACSS-SUBTHEME directory into
sites/all/themes and rename it to your_theme_name.

2. Then go to sites/all/themes/your_theme and rename BOOTSMACSS-SUBTHEME.info.txt
to your_theme_name.info.

3. Copy the whole content of bootsmacss folder located in the root of bootsmacss
repository into your newly created theme so that there were following folders and files:

bootstrap-sass/*
css/*
images/*
_includes/*
js/*
_layouts/*
_plugins/*
sass/*
styleguide/*
_config.yml
Gruntfile.js
index.html
package.json

etc.

These files are not already here because we do not want replicated data inside
bootsmacss repository. Another reason is, because they may be used with other
technologies than Drupal.

4. Now run following command to install all node.js dependencies:
$ npm install

5. START CUSTOMIZING! To watch for changes inside SASS files, go to your theme
root and run following command. New CSS file will be generated on every change.
$ grunt

You can see the generated BootSMACSS web components styleguide of this theme at:
/sites/all/themes/your_theme_name/styleguide/assets/index.html
