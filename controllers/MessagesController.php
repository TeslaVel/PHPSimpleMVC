<?php
require_once './models/Message.php';
require_once './models/User.php';

require_once './views/helpers/RenderView.php';
require_once './views/helpers/Redirect.php';

class MessagesController extends MessageModel {

    public $indexUrl;

    public function __construct() {
      parent::__construct();
      $this->indexUrl = '/'.Config::getAppPath().'/messages';
    }

    public function index() {
      // Mostrar la lista de usuarios
      $messages = $this->getAllMessages();
      RenderView::render('messages/index', ['messages' => $messages]);
    }

    public function show($id) {
      // Mostrar un usuario específico
      $message = $this->getMessageById($id);

      if ( empty($message)) Redirect::redirectTo($this->indexUrl);

      RenderView::render('messages/show', ['message' => $message]);
    }

    public function new() {
      $userModel = new UserModel();
      $users = $userModel->getAllUsers();

      RenderView::render('messages/new', ['users' => $users]);
    }

    public function create() {
      $title = isset($_POST['title']) ? $_POST['title'] : null; // Evitar errores si no existe el campo
      $message_content = isset($_POST['message']) ? $_POST['message'] : null;
      $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

      // $user = $this->getMessageById($id);

      // if ( empty($user)) {
      //   $url = '/'.Config::getAppPath().'/messages';
      //   header("Location: $url");
      //   exit;
      // }

      $id = $this->createMessage($title, $message_content, $user_id);

      Redirect::redirectTo($this->indexUrl);
    }

    public function edit($id) {
      $message = $this->getMessageById($id);
      $userModel = new UserModel();
      $users = $userModel->getAllUsers();

      if ( empty($message)) {
        return Redirect::redirectTo($this->indexUrl);
      }

      $message = $this->getMessageById($id);
      RenderView::render('messages/edit', ['message' => $message]);
    }

    public function update($id) {
      // Actualizar un usuario

      $message = $this->getMessageById($id);

      if ( empty($message)) {
        return Redirect::redirectTo($this->indexUrl);
      }

      $title = isset($_POST['title']) ? $_POST['title'] : null;
      $message_content = isset($_POST['message']) ? $_POST['message'] : null;
      $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

      $affected = $this->updateMessage($id, $title, $message_content, $user_id);

      return Redirect::redirectTo("$this->indexUrl/$id");
    }

    public function delete($id) {
      $affected = $this->deleteMessage($id);

      return Redirect::redirectTo($this->indexUrl);
    }
}
?>
