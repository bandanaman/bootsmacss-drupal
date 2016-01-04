<div class="panel panel-default">
  <div class="panel-heading">
    <a data-toggle="collapse" data-parent="#accordion" href="#accordion-<?php print $element['numering']; ?>" aria-controls="accordion-<?php print $element['numering']; ?>">
      <h4 class="panel-title">
        <?php if (!empty($element['heading'])): ?>
          <?php print $element['heading']; ?>
        <?php else: ?>
          <?php print $element['empty_heading']; ?>
        <?php endif; ?>
        <span class="pull-right"><i class="glyphicon glyphicon-<?php if (!empty($element['open'])): ?>minus<?php else: ?>plus<?php endif; ?>"></i></span>
      </h4>
    </a>
  </div>
  <div id="accordion-<?php print $element['numering']; ?>" class="panel-collapse collapse<?php if (!empty($element['open'])): ?> in<?php endif; ?>" role="tabpanel" aria-labelledby="accordion-<?php print $element['numering']; ?>">
    <div class="panel-body">
      <?php print render($element['entity']); ?>
    </div>
  </div>
</div>
