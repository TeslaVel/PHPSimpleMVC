<?php

if ( empty($post)) {
    echo "Post not found";
    return;
}

ob_start();

?>
<div class="col-4 mx-auto pt-3">
  <form action="/<?php echo URL::getAppPath(); ?>/posts/update/<?php echo $post->id; ?>" method="POST" class="mb-3">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="post[title]" id="title" class="form-control" value="<?php echo $post->title; ?>" required>
    </div>

    <div class="form-group">
        <label for="post">Bldy:</label>
        <textarea name="post[body]" id="body" class="form-control" required><?php echo $post->body; ?></textarea>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success">Update Post</button>
      <a class="btn btn-danger"
        href="/<?php echo URL::getAppPath(); ?>/posts">
        Back
      </a>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
?>
