<?php
ob_start();
?>

<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo Config::getAppPath(); ?>/posts/create" method="post" class="mb-3">
    <div class="form-group">
      <label for="post">Title:</label>
      <input type="text" name="post[title]" id="title" class="form-control" value="" required>
    </div>

    <div class="form-group">
      <label for="post">Body:</label>
      <textarea name="post[body]" id="body" class="form-control" required></textarea>
    </div>
   
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Create Post</button>
      <a class="btn btn-danger"
        href="/<?php echo Config::getAppPath(); ?>/posts">
        Back
      </a>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
?>
