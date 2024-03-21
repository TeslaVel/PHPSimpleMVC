<?php
ob_start();
?>

<div>
  <h1 class="text-center">Posts</h1>
  <div class="text-right">
    <a
      class="btn btn-success"
      href="/<?php echo Config::getAppPath(); ?>/posts/new">
      New Post
    </a>
  </div>
  <table class="table table-stripped mt-3"  width="100%">
   <thead>
      <th>Title</th>
      <th>Body</th>
      <th class="text-center">Actions</th>
   </thead>
    <tbody>
      <?php foreach ($posts  as $post) {
        echo '<tr>';
          echo '<td>' . $post['title'] . '</td>';
          echo '<td>' . $post['body'] . '</td>';
          // Add a new column for actions
          echo '<td class="text-center">';
            // Edit link
            echo '<a class="btn btn-sm btn-primary mx-1" href="/' . Config::getAppPath() . '/posts/' . $post['id'] . '">View</a>';
            echo '<a class="btn btn-sm btn-warning mx-1" href="/' . Config::getAppPath() . '/posts/edit/' . $post['id'] . '">Edit</a>';
            // Delete link with POST form
            echo '<form style="display:inline-block;" method="POST" action="/' . Config::getAppPath() . '/posts/delete/'.$post['id'].' ">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="post_id" value="' . $post['id'] . '">';
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
