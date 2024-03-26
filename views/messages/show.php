<?php
ob_start();
?>
<div class="card col-5 mx-auto mt-5" style="">
  <div class="card-body p-3">
    <h5 class="card-title text-center">Message Detail</h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <p class="card-text">
      <ul class="list-unstyled">
        <li><strong>Message:</strong> <?php echo $message->message; ?></li>
        <li><strong>User:</strong> <?php echo $message->user_id; ?></li>
        <li><strong>Post:</strong> <?php echo $message->post()->title; ?></li>
      </ul>
    </p>
    <div class="d-flex justify-content-center mt-5">
      <a href="/<?php echo  URL::getAppPath(); ?>/messages/edit/<?php echo $message->id; ?>" class="btn btn-success mx-2">Edit</a>
      <a href="/<?php echo  URL::getAppPath(); ?>/messages" class="btn btn-danger mx-2">Back</a>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
?>
