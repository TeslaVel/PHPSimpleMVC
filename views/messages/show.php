<?php
ob_start();
?>

<div class="">
  <h1>Message Detail</h1>
  <ul>
    <li><strong>Title:</strong> <?php echo $message['title']; ?></li>
    <li><strong>Message:</strong> <?php echo $message['message']; ?></li>
    <li><strong>Created By:</strong> <?php echo $message['user_id']; ?></li>
  </ul>
  <a href="/<?php echo  Config::getAppPath(); ?>/messages" class="btn btn-primary">Back</a>
</div>

<?php
$content = ob_get_clean();

include_once "./layout.php";
?>
