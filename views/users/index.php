<?php

$fields = [
    ['name' => 'id',],
    ['name' => 'email', 'linked' => true],
    ['name' => 'first_name'],
    ['name' => 'last_name'],
    ['name' => 'messages', 'callable' => 'messages->count'],
    ['name' => 'posts', 'callable' => 'posts->count']
];

$table = TableComponent::render($users, 'users', $fields, [], 'User Lists');


ob_start();
?>

<div>
  <h1 class="text-center">Users</h1>
  <div class="col-12">
    <?php echo $table; ?>
  </div>
</div>

<?php
  $content = ob_get_clean();
?>
