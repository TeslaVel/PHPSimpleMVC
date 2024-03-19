<?php
ob_start();
?>

<div class="">
  <h1>User Detail</h1>
  <ul>
    <li><strong>Email:</strong> <?php echo $user['email']; ?></li>
    <li><strong>Nombre:</strong> <?php echo $user['first_name']; ?></li>
    <li><strong>Apellido:</strong> <?php echo $user['last_name']; ?></li>
  </ul>
  <a href="/<?php echo  Config::getAppPath(); ?>/users" class="btn btn-primary">Back</a>
</div>

<?php
$content = ob_get_clean();

include_once "./layout.php";
?>
