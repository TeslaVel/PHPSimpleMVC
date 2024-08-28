<?php

$fields = [
    ['name' => 'id',],
    ['name' => 'message', 'linked' => true],
    ['name' => 'email', 'callable' => 'user' ],
    ['name' => 'title', 'callable' => 'post' ],
];

$table = TableComponent::render($messages, 'messages', $fields, [], 'Message Lists');

ob_start();
?>

<div>
  <h1 class="text-center">Messages</h1>
  <div class="col-12">
    <?php echo $table; ?>
  </div>
</div>

<?php
  $content = ob_get_clean();
?>
