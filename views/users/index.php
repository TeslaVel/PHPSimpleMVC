<?php
ob_start();
?>

<div>
  <?= '<h1 class="text-center">Users</h1>'; ?>
  <div class="text-right">
    <a
      class="btn btn-success"
      href="/<?php echo Config::getAppPath(); ?>/users/new">
      New User
    </a>
  </div>
  <table class="table table-stripped mt-3">
   <thead>
      <th>Email</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th class="text-center">Actions</th>
   </thead>
    <tbody>
      <?php foreach ($users as $user) {
        echo '<tr>';
          echo '<td>' . $user['email'] . '</td>';
          echo '<td>' . $user['first_name'] . '</td>';
          echo '<td>' . $user['last_name'] . '</td>';
          // Add a new column for actions
          echo '<td class="text-center">';
            // Edit link (unchanged)
            echo '<a class="btn btn-sm btn-primary mx-1" href="/' . Config::getAppPath() . '/users/' . $user['id'] . '">View</a>';
            echo '<a class="btn btn-sm btn-warning mx-1" href="/' . Config::getAppPath() . '/users/edit/' . $user['id'] . '">Edit</a>';
            // Delete link with POST form and confirmation
            echo '<form style="display:inline-block;" method="POST" action="/' . Config::getAppPath() . '/users/delete/'. $user['id'] . ' ">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<input type="hidden" name="user_id" value="' . $user['id'] . '">';
            echo '<button type="submit" class="btn btn-sm btn-danger mx-1" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>';
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
