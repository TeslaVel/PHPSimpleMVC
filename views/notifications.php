<?php
$flash = Flashify::getFlash();

if ($flash) { ?>
  <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <?php echo $flash['message']; ?>
  </div>
<?php } ?>
