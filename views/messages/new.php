<?php
ob_start();
?>

<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo Config::getAppPath(); ?>/messages/create" method="post" class="mb-3">
    <input type="hidden" name="action" value="create">
    <div class="form-group">
      <label for="title">Título:</label>
      <input type="text" name="message[title]" id="title" class="form-control" required>
      <input type="text" name="message[algo]" id="title" class="form-control" value="" required>

    </div>
    <div class="form-group">
      <label for="message">Mensaje:</label>
      <textarea name="message[message]" id="message" class="form-control" required></textarea>
    </div>
    <div class="form-group">
      <label for="user_id">ID del Usuario:</label>
      <select name="message[user_id]" id="user_id" class="form-control" required>
        <?php foreach ($users  as $user) {
          echo '<option value="' . $user['id'] . '">';
          echo $user['email'];
          echo '</option>';
        } ?>
      </select>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Crear mensaje</button>
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
