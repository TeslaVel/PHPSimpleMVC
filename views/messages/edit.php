<?php

if ( empty($message)) {
    echo "Message not found";
    return;
}

ob_start();

?>
<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo Config::getAppPath(); ?>/messages/update/<?php echo $message['id']; ?>" method="POST" class="mb-3">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="message[id]" value="<?php echo $message['id']; ?>">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="message[title]" id="title" class="form-control" value="<?php echo $message['title']; ?>" required>
    </div>
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea name="message[message]" id="message" class="form-control" required><?php echo $message['message']; ?></textarea>
    </div>

    <div class="form-group">
      <label for="user_id">User ID:</label>
      <select name="message[user_id]" id="user_id" class="form-control" required>
        <?php foreach ($users  as $user) {
          $selected = (isset($message['user_id']) && $message['user_id'] == $user['id']) ? 'selected' : '';
          echo '<option value="' . $user['id'] . '" ' . $selected . '>';
          echo $user['email'];
          echo '</option>';
        } ?>
      </select>
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
