<?php
ob_start();
?>

<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo URL::getAppPath(); ?>/users/update/<?php echo $user->id; ?>" method="POST" class="mb-3">
    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" name="user[first_name]" id="first_name" class="form-control" value="<?php echo $user->first_name; ?>" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" name="user[last_name]" id="last_name" class="form-control" value="<?php echo $user->last_name; ?>" required>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success">Update User</button>
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
