<?php
require_once 'BaseController.php';

require_once './models/Message.php';
require_once './models/User.php';
require_once './views/helpers/Redirect.php';

class MessagesController extends BaseController {
  use Redirect;
  // private $messageModel;
  public $indexUrl;
  private $messageModel;

  public function __construct() {
    parent::__construct();
    $this->messageModel = new MessageModel();
    $this->indexUrl = '/'.Config::getAppPath().'/messages';
  }

  public function index() {
    // Mostrar la lista de usuarios
    $messages = $this->messageModel->getAllMessages();
    $this->renderView('messages/index', ['messages' => $messages]);
  }

  public function show($id) {
    // Mostrar un usuario específico
    $message = $this->messageModel->findById($id);

    if ( empty($message)) $this->redirectTo($this->indexUrl);

    $this->renderView('messages/show', ['message' => $message]);
  }

  public function new() {
    $userModel = new UserModel();
    $users = $userModel->getAllUsers();

    $this->renderView('messages/new', ['users' => $users]);
  }

  public function create() {
    $data = $_POST['message'];
    $userModel = new UserModel();
    $user = $userModel->findById($data['user_id']);

    if ( empty($user)) {
      $url = '/'.Config::getAppPath().'/messages';
      header("Location: $url");
      exit;
    }

    $id = $this->messageModel->createMessage($data);

    $this->redirectTo($this->indexUrl);
  }

  public function edit($id) {
    $message = $this->messageModel->findById($id);
    $userModel = new UserModel();
    $users = $userModel->getAllUsers();

    if ( empty($message)) {
      return $this->redirectTo($this->indexUrl);
    }

    $message = $this->messageModel->findById($id);
    $this->renderView('messages/edit', ['message' => $message, 'users' => $users]);
  }

  public function update($id) {
    $message = $this->messageModel->findById($id);

    if (empty($message)) {
      return $this->redirectTo($this->indexUrl);
    }

    $data = $_POST['message'];

    $affected = $this->messageModel->updateMessage($id, $data);

    return $this->redirectTo("$this->indexUrl/$id");
  }

  public function delete($id) {
    $affected = $this->messageModel->deleteMessage($id);

    return $this->redirectTo($this->indexUrl);
  }
}
