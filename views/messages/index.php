<?php
ob_start();
?>

<div>
  <?= '<h1 class="text-center">Messages</h1>'; ?>
  <div class="text-right">
    <a
      class="btn btn-success"
      href="/<?php echo Config::getAppPath(); ?>/messages/new">
      New Message
    </a>
  </div>
  <table class="table table-stripped mt-3">
   <thead>
      <th>Title</th>
      <th>Comment</th>
      <th class="text-center">Actions</th>
   </thead>
    <tbody>
      <?php foreach ($messages  as $msg) {
        echo '<tr>';
          echo '<td>' . $msg['title'] . '</td>';
          echo '<td>' . $msg['message'] . '</td>';
          // Add a new column for actions
          echo '<td class="text-center">';
            // Edit link
            echo '<a class="btn btn-sm btn-primary mx-1" href="/' . Config::getAppPath() . '/messages/' . $msg['id'] . '">View</a>';
            echo '<a class="btn btn-sm btn-warning mx-1" href="/' . Config::getAppPath() . '/messages/edit/' . $msg['id'] . '">Edit</a>';
            // Delete link with POST form
            echo '<form style="display:inline-block;" method="POST" action="/' . Config::getAppPath() . '/messages/delete/'.$msg['id'].' ">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="message_id" value="' . $msg['id'] . '">';
            echo '<button type="submit" class="btn btn-sm btn-danger mx-1" onclick="return confirm(\'Are you sure you want to delete this message?\')">Delete</button>';
            echo '</form>';
          echo '</td>';
        echo '</tr>';
      } ?>
    </tbody>
  </table>
</div>

<?php
  $content = ob_get_clean();

  include_once "./layout.php";
?>
