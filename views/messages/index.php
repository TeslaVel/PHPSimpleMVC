<?php
ob_start();
?>

<div>
  <h1 class="text-center">Messages</h1>
  <table class="table table-stripped mt-3"  width="100%">
   <thead>
      <th>Comment</th>
      <th class="text-center">Actions</th>
   </thead>
    <tbody>
      <?php foreach ($messages  as $msg) {
        echo '<tr>';
          echo '<td>' . $msg->message . '</td>';
          // Add a new column for actions
          echo '<td class="text-center">';
            // Edit link
            echo '<a class="btn btn-sm btn-primary mx-1" href="/' . URL::getAppPath() . '/messages/' . $msg->id . '">View</a>';
            echo '<a class="btn btn-sm btn-warning mx-1" href="/' . URL::getAppPath() . '/messages/edit/' . $msg->id . '">Edit</a>';
            // Delete link with POST form
            echo '<form style="display:inline-block;" method="POST" action="/' . URL::getAppPath() . '/messages/delete/'.$msg->id.' ">';
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
?>
