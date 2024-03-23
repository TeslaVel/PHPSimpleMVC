<?php

if ( empty($message)) {
    echo "Message not found";
    return;
}

ob_start();

?>
<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo Config::getAppPath(); ?>/messages/update/<?php echo $message->id; ?>" method="POST" class="mb-3">
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea name="message[message]" id="message" class="form-control" required><?php echo $message->message; ?></textarea>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success">Update Message</button>
      <a class="btn btn-danger"
        href="/<?php echo Config::getAppPath(); ?>/messages">
        Back
      </a>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
?>
