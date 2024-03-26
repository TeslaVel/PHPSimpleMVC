<?php
require_once 'core/controllers/BaseController.php';

class MessagesController extends BaseController {
  public $indexUrl;
  private $messageModel;
  private $logger;

  public function __construct(Logger $logger) {
    parent::__construct();
    $this->logger = $logger;
    $this->messageModel = new Message();
    $this->indexUrl = '/'.URL::getAppPath().'/posts';
  }

  public function index() {
    $this->logger->log('Enter to Index Messages');
    $messages = $this->messageModel->findAll()->all();

    Render::view('messages/index', compact('messages'));
  }

  public function show($id) {
    $message = $this->messageModel->find($id);

    if ( empty($message)) return Redirect::to($this->indexUrl);

    Render::view('messages/show', compact('message'));
  }

  public function create() {
    $data = $_POST['message'];

    if (!Auth::check()) return Redirect::to($this->indexUrl);

    $id = $this->messageModel->save([
      ...$data,
      'user_id' => Auth::user()->id
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
    $users = $userModel->findAll()->all();

    if ( empty($message)) return Redirect::to($this->indexUrl);

    Render::view('messages/edit', compact('message', 'users'));
  }

  public function update($id) {
    $message = $this->messageModel->find($id);

    if (empty($message)) return Redirect::to($this->indexUrl);

    $data = $_POST['message'];

    $affected = $message->update($data);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Message was updated',
      ]);
    }

    return Redirect::to('/'.URL::getAppPath().'/messages/'.$id);
  }

  public function delete($id) {
    $message = $this->messageModel->find($id);
    $affected = $message->delete();

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'Message was deleted',
      ]);
    }

    return Redirect::to($this->indexUrl.'/'.$message->post_id);
  }
}
