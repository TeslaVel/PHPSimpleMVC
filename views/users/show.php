<?php
ob_start();
?>
<div class="card col-5 mx-auto mt-5" style="">
  <div class="card-body p-3">
    <h5 class="card-title text-center">User Detail</h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <p class="card-text">
      <ul class="list-unstyled">
        <li><strong>Email:</strong> <?php echo $user->email; ?></li>
        <li><strong>Nombre:</strong> <?php echo $user->first_name; ?></li>
        <li><strong>Apellido:</strong> <?php echo $user->last_name; ?></li>
      </ul>
    </p>
    <div class="d-flex justify-content-center mt-5">
      <a href="/<?php echo  URL::getAppPath(); ?>/users/edit/<?php echo $user->id; ?>" class="btn btn-success mx-2">Edit</a>
      <a href="/<?php echo  URL::getAppPath(); ?>/users" class="btn btn-danger mx-2">Back</a>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
?>
