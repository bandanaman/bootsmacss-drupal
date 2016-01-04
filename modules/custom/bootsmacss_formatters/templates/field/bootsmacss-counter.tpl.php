<!-- Component counter -->
<div id="counter-<?php print $element['id']; ?>" class="counter<?php if (isset($element['empty'])): ?> counter--open<?php endif; ?><?php if ($element['force_big']): ?> counter--fixed-big<?php endif; ?>">
  <div class="counter__pie" data-percent="<?php print $element['percentage']; ?>">
    <span class="counter__left">
      <?php print $element['left']; ?>
    </span>
  </div>
  <span class="counter__label">
    <?php print $element['label']; ?>
  </span>
  <?php if (isset($element['caption'])) : ?>
    <span class="counter__caption">
      <?php print $element['caption']; ?>
    </span>
  <?php endif; ?>
</div>
<!-- /Component counter -->
