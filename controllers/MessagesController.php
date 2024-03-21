<?php
require_once 'BaseController.php';

class MessagesController extends BaseController {
  public $indexUrl;
  private $messageModel;
  private $logger;

  public function __construct(Logger $logger) {
    parent::__construct();
    $this->logger = $logger;
    $this->messageModel = new Message();
    $this->indexUrl = '/'.Config::getAppPath().'/posts';
  }

  public function index() {
    $this->logger->log('Enter to Index Messages');
    $messages = $this->messageModel->findAll();
    Render::view('messages/index', compact('messages'));
  }

  public function show($id) {
    $message = $this->messageModel->find($id);

    if ( empty($message)) return Redirect::to($this->indexUrl);

    Render::view('messages/show', compact('message'));
  }

  public function new() {
    $userModel = new User();
    $users = $userModel->findAll();

    Render::view('messages/new', compact('users'));
  }

  public function create() {
    $data = $_POST['message'];
    $userModel = new User();
    $user_id = Auth::user()['id'];

    if ( !Auth::check() ) return Redirect::to($this->indexUrl);

    $id = $this->messageModel->save([
      ...$data,
      'user_id' => $user_id
    ]);

    if ($id > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Message was create',
      ]);
    }

    Redirect::to($this->indexUrl.'/'.$data['post_id']);
  }

  public function edit($id) {
    $message = $this->messageModel->find($id);
    $userModel = new User();
    $users = $userModel->findAll();

    if ( empty($message)) return Redirect::to($this->indexUrl);

    $message = $this->messageModel->find($id);
    Render::view('messages/edit', compact('message', 'users'));
  }

  public function update($id) {
    $message = $this->messageModel->find($id);

    if (empty($message)) return Redirect::to($this->indexUrl);

    $data = $_POST['message'];

    $affected = $this->messageModel->update($id, $data);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Message was updated',
      ]);
    }

    return Redirect::to('/'.Config::getAppPath().'/messages/'.$id);
  }

  public function delete($id) {
    $affected = $this->messageModel->delete($id);
    $post_id = $_POST['post_id'];

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'Message was deleted',
      ]);
    }

    return Redirect::to($this->indexUrl.'/'.$post_id);
  }
}
