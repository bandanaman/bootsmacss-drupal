<script>
jQuery(document).ready(function(){
  jQuery('#modal-trigger-<?php print $element['id']; ?>').click(function(){
    jQuery('#modal-<?php print $element['id']; ?>').css('left','0');
  });
  jQuery('#modal-<?php print $element['id']; ?>').click(function(){
    jQuery(this).css('left','-100000px');
  }).children().click(function(e) {
    return false;
  });
});
</script>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-block btn-lg visible-lg" id="modal-trigger-<?php print $element['id']; ?>">
  Show <?php print $element['label']; ?>
</button>
<div class="box hidden-lg"><p>Statistics are only available on devices supporting minimal resolution of 1200px</p></div>

<!-- Modal -->
<div class="modal visible-lg" id="modal-<?php print $element['id']; ?>" style="display: block;  width: 100%; overflow: scroll; left: -100000px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <?php print $element['value']; ?>
      </div>
    </div>
  </div>
</div>
