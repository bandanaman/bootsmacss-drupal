<?php
/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any.
 *
 * @ingroup views_templates
 */
?>
  <!-- Component listing -->

<?php /* Listing header element */ ?>
<div class="listing <?php print $classes; ?>">
  <?php if (!$is_page && $title || $more): ?>
    <?php if ($title && $more): ?>
      <div class="title-more">
        <div class="title-more__row">
          <div class="title-more__col"><?php print $title; ?></div>
          <div class="title-more__col"><?php print $more; ?></div>
        </div>
      </div>
    <?php elseif ($title): ?>
      <h2 class="listing__label"><?php print $title; ?></h2>
    <?php elseif ($more): ?>
      <div class="listing__label"><?php print $more; ?></div>
    <?php endif; ?>
  <?php endif; ?>
  <?php /* /Listing header element */ ?>

  <?php if ($header): ?>
    <div class="listing__header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php /* View elements before Listing */ ?>
  <?php if ($exposed): ?>
    <div class="listing__filters">
        <?php print $exposed; ?>
    </div>
  <?php endif; ?>
  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>
  <?php /* /View elements before Listing */ ?>

  <?php /* Listing */ ?>
  <?php if ($rows): ?>
    <?php print $rows; ?>
  <?php elseif ($empty): ?>
    <div class="view-empty">
        <?php print $empty; ?>
    </div>
  <?php endif; ?>
  <?php /* /Listing */ ?>

  <?php /* View elements after Listing */ ?>
  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>
  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>
  <?php if ($footer): ?>
    <div class="listing__footer">
        <?php print $footer; ?>
    </div>
  <?php endif; ?>
  <?php if ($feed_icon): ?>
    <div class="feed-icon">
        <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>
</div>
<?php /* /View elements after Listing */ ?>
  <!-- /Component listing -->
