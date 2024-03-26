<?php
ob_start();
?>
<div class="card col-5 mx-auto mt-3" style="">
  <div class="card-body p-3">
    <h5 class="card-title text-center">Post Detail</h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <p class="card-text">
      <ul class="list-unstyled">
        <li><strong>Title:</strong> <?php echo $post->title; ?></li>
        <li><strong>Body:</strong> <?php echo $post->body; ?></li>
        <li><strong>User:</strong> <?php print_r($post->user()->email); ?></li>
        <li><strong>Comments:</strong> <?php echo $post->messages()->count(); ?></li>
      </ul>
    </p>
    <div class="d-flex justify-content-end mt-2">
      <a href="/<?php echo  URL::getAppPath(); ?>/posts/edit/<?php echo $post->id; ?>" class="btn btn-success mx-1">Edit</a>
    </div>
  </div>
  <hr>

  <form action="/<?php echo URL::getAppPath(); ?>/messages/create" method="post" class="mb-3">
    <input type="hidden" name="message[post_id]" value="<?php echo $post->id; ?>">
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea name="message[message]" id="message" class="form-control" required></textarea>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Create Message</button>
      <a class="btn btn-danger"
        href="/<?php echo URL::getAppPath(); ?>/posts">
        Back
      </a>
    </div>
  </form>
</div>

<?php if (count($messages) > 0 ) { ?>
  <div class="col-5 px-0 mx-auto mt-3" style="height: 320px;overflow: scroll;">
    <?php foreach ($messages  as $msg) { ?>
      <div class="card mt-2">
        <div class="card-body p-3">
          <h6 class="card-subtitle mb-2 text-muted"></h6>
          <p class="card-text">
            <?php echo $msg->message; ?>
          </p>
          <div>
            Created by: <?php echo $msg->user_id; ?>
          </div>
          <div class="d-flex justify-content-end mt-2">
            <a href="/<?php echo  URL::getAppPath(); ?>/messages/edit/<?php echo $msg->id; ?>" class="btn btn-success mx-1">Edit</a>
            <form style="display:inline-block;" method="POST" action="/<?php echo URL::getAppPath(); ?>/messages/delete/<?php echo $msg->id; ?>">
              <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
              <button type="submit" class="btn btn-sm btn-danger mx-1 p-2" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
            </form>
          </div>
        </div>
       </div>
    <?php } ?>
  </div>
<?php } ?>

<?php
$content = ob_get_clean();
?>
