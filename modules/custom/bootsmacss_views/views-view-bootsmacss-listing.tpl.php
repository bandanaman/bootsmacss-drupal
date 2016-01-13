<?php
/**
 * @file
 * View template to display a news carousel.
 *
 * @ingroup views_templates
 */
?>

<div class="listing <?php print $listing_classes; ?>">
  <?php if (empty($listing_columns)): ?>
    <?php foreach ($columns as $column): ?>
      <?php foreach ($column as $id => $row): ?>
        <div class="listing__item">
          <?php print $row; ?>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>
  <?php else : ?>
    <?php foreach ($columns as $column): ?>
      <div class="listing__column">
        <?php foreach ($column as $id => $row): ?>
          <div class="listing__item">
            <?php print $row; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
