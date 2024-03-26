<?php
ob_start();
?>

<div>
  <h1 class="text-center">Posts</h1>
  <div class="text-right">
    <a
      class="btn btn-success"
      href="/<?php echo URL::getAppPath(); ?>/posts/new">
      New Post
    </a>
  </div>
  <table class="table table-stripped mt-3"  width="100%">
   <thead>
      <th>ID</th>
      <th>Title</th>
      <th>User</th>
      <th>Body</th>
      <th>Comments</th>
      <th class="text-center">Actions</th>
   </thead>
    <tbody>
      <?php foreach ($posts  as $post) {
        echo '<tr>';
          echo '<td>' . $post->id . '</td>';
          echo '<td>' . $post->title . '</td>';
          echo '<td>' . $post->user()->email . '</td>';
          echo '<td>' . $post->body. '</td>';
          echo '<td>' . $post->messages()->count()  .'</td>';
          echo '<td class="text-center">';
            echo '<a class="btn btn-sm btn-primary mx-1" href="/' . URL::getAppPath() . '/posts/' . $post->id . '">View</a>';
            echo '<a class="btn btn-sm btn-warning mx-1" href="/' . URL::getAppPath() . '/posts/edit/' . $post->id . '">Edit</a>';
            echo '<form style="display:inline-block;" method="POST" action="/' . URL::getAppPath() . '/posts/delete/'.$post->id.' ">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="post_id" value="' . $post->id . '">';
            echo '<button type="submit" class="btn btn-sm btn-danger mx-1" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</button>';
            echo '</form>';
          echo '</td>';
        echo '</tr>';
      } ?>
    </tbody>
  </table>
</div>

<?php
  $content = ob_get_clean();
?>
