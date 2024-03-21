<?php
require_once 'BaseController.php';

class PostsController extends BaseController {
  public $indexUrl;
  private $postModel;

  public function __construct() {
    parent::__construct();
    $this->postModel = new Post();
    $this->indexUrl = '/'.Config::getAppPath().'/posts';
  }

  public function index() {
    $posts = $this->postModel->findAll();
    Render::view('posts/index', compact('posts'));
  }

  public function show($id) {
    $post = $this->postModel->find($id);
    $messageModel = new Message();
    $messages = $messageModel->findBy('post_id', $id);

    if ( empty($post)) return Redirect::to($this->indexUrl);

    Render::view('posts/show', compact('post', 'messages'));
  }

  public function new() {
    $userModel = new User();
    $users = $userModel->findAll();

    Render::view('posts/new', compact('users'));
  }

  public function create() {
    $data = $_POST['post'];
    $userModel = new User();
    $user_id = Auth::user()['id'];
    $user = $userModel->find($user_id);

    if ( empty($user)) return Redirect::to($this->indexUrl);

    $id = $this->postModel->save([
      ...$data,
      'user_id' => $user_id
    ]);

    if ($id > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Post was create',
      ]);
    }

    Redirect::to($this->indexUrl);
  }

  public function edit($id) {
    $post = $this->postModel->find($id);
    $userModel = new User();
    $users = $userModel->findAll();

    if ( empty($post)) return Redirect::to($this->indexUrl);

    $post = $this->postModel->find($id);
    Render::view('posts/edit', compact('post', 'users'));
  }

  public function update($id) {
    $post = $this->postModel->find($id);

    if (empty($post)) return Redirect::to($this->indexUrl);

    $data = $_POST['post'];

    $user_id = Auth::user()['id'];

    $newData = [
      ...$data,
      'user_id' => $user_id
    ];

    $affected = $this->postModel->update($id, $newData);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Post was updated',
      ]);
    }

    return Redirect::to("$this->indexUrl/$id");
  }

  public function delete($id) {
    $affected = $this->postModel->delete($id);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'Post was deleted',
      ]);
    }

    return Redirect::to($this->indexUrl);
  }
}
