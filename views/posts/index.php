<?php


$fields = [
    ['name' => 'id',],
    ['name' => 'title', 'linked' => true],
    ['name' => 'email', 'callable' => 'user' ],
    ['name' => 'body'],
    ['name' => 'messages', 'callable' => 'messages->count']
];


$table = TableComponent::render($posts, 'posts', $fields, [], 'Post Lists', []);

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
  <div class="col-12">
    <?php echo $table; ?>
  </div>
</div>

<?php
  $content = ob_get_clean();
?>
