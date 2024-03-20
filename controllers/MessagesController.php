<?php
require_once 'BaseController.php';

class MessagesController extends BaseController {
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
    $messages = $this->messageModel->findAll();
    Render::view('messages/index', compact('messages'));
  }

  public function show($id) {
    // Mostrar un usuario específico
    $message = $this->messageModel->findById($id);

    if ( empty($message)) return Redirect::to($this->indexUrl);

    Render::view('messages/show', ['message' => $message]);
  }

  public function new() {
    $userModel = new UserModel();
    $users = $userModel->getAllUsers();

    Render::view('messages/new', ['users' => $users]);
  }

  public function create() {
    $data = $_POST['message'];
    $userModel = new UserModel();
    $user = $userModel->findById($data['user_id']);

    if ( empty($user)) return Redirect::to($this->indexUrl);

    $id = $this->messageModel->createMessage($data);

    if ($id > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Message was create',
      ]);
    }


    Redirect::to($this->indexUrl);
  }

  public function edit($id) {
    $message = $this->messageModel->findById($id);
    $userModel = new UserModel();
    $users = $userModel->getAllUsers();

    if ( empty($message)) return Redirect::to($this->indexUrl);

    $message = $this->messageModel->findById($id);
    Render::view('messages/edit', ['message' => $message, 'users' => $users]);
  }

  public function update($id) {
    $message = $this->messageModel->findById($id);

    if (empty($message)) return Redirect::to($this->indexUrl);

    $data = $_POST['message'];

    $affected = $this->messageModel->updateMessage($id, $data);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Message was updated',
      ]);
    }

    return Redirect::to("$this->indexUrl/$id");
  }

  public function delete($id) {
    $affected = $this->messageModel->deleteMessage($id);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'Message was deleted',
      ]);
    }

    return Redirect::to($this->indexUrl);
  }
}
