<?php
ob_start();
?>

<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo URL::getAppPath(); ?>/users/create" method="POST" class="mb-3">
    <input type="hidden" name="action" value="create">
    <div class="form-group">
      <label for="first_name">First Name:</label>
      <input type="text" name="user[first_name]" id="first_name" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="last_name">Last Name:</label>
      <input type="text" name="user[last_name]" id="last_name" class="form-control" required>
    </div>
    <!-- <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="user[email]" id="email" class="form-control" required>
    </div> -->
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Create User</button>
      <a class="btn btn-danger"
        href="/<?php echo URL::getAppPath(); ?>/users">
        Back
      </a>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
?>
