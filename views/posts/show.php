<?php

$fields_show = [
    ['name' => 'id',],
    ['name' => 'title'],
    ['name' => 'email', 'callable' => 'user' ],
    ['name' => 'body'],
    ['name' => 'comments', 'callable' => 'messages->count']
];


$table = TableShowComponent::render([
          'path' => 'posts', 'record' => $post,
          'fields' => $fields_show,
          'table_classes' => ['classes' => "table-borderless"],
          'card_classes' => [
            'classes' => '',
            'card_footer' => ['classes' => 'd-flex justify-content-end']
          ]
        ]);



$fields_comment = [
    ['type' => 'hidden', 'name' => 'message[post_id]', 'value' => $post->id],
    [
      'type' => 'text', 'name' => 'message[message]', 'label' => 'Message',
      'required' => true,
      'is_row' => true,
    ]
];

$action_buttons_comment = [
  // 'submit' => ['label' => 'Update'],
  'back' => ['label' => 'Back', 'url' => '/'.URL::getAppPath().'/posts']
];

$form_comment = FormComponent::render([
            'path' => 'messages', 'is_new' => true, 'title' => 'Create Comment',
            'fields' => $fields_comment, 'custom_url_action' => null,
            'action_buttons' => $action_buttons_comment
            ]);


ob_start();
?>
<div class="col-8 mx-auto mt-5" style="">
  <?php echo $table; ?>
  <hr>

  <?php echo $form_comment; ?>

  <hr>
</div>
<?php if (count($messages) > 0 ) { ?>
  <div class="col-8 mx-auto mt-3 text-center">Comments</div>
  <div class="col-8 mx-auto mt-3" style="height: 320px;overflow: scroll;">
    <?php foreach ($messages  as $msg) { ?>
      <?php echo CardComponent::render([
                    'body_text' => $msg->message,
                    'card_footer_classes' => 'px-3 py-2 d-flex justify-content-end align-items-center mt-2',
                    'action_buttons' => [
                      'delete' => [
                        'path' => "messages/delete/$msg->id",
                      ],
                      'edit' => [
                        'path' => "messages/edit/$msg->id",
                        'with_icon' => true
                      ]
                    ]
                 ]); ?>
    <?php } ?>
  </div>
<?php } ?>

<?php
$content = ob_get_clean();
?>
