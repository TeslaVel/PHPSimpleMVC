<?php

if ( empty($message)) {
    echo "Message not found";
    return;
}

$fields = [
  [
      'type' => 'textarea', 'name' => 'message[message]', 'label' => 'Message',
      'required' => true,
      'value' => $message->message,
      'is_row' => false,
  ]
];

$action_buttons = [
'submit' => ['label' => 'Update'],
'back' => ['label' => 'Back', 'url' => '/'.URL::getAppPath().'/messages']
];

$form = FormComponent::render([
          'path' => 'messages', 'is_new' => false, 'title' => 'Update Message',
          'record' => $message, 'fields' => $fields, 'custom_url_action' => null,
          'action_buttons' => $action_buttons
          ]);


ob_start();

?>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-5">
  <?php echo $form; ?>
</div>

<?php
$content = ob_get_clean();
?>
