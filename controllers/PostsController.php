<?php

class PostsController extends BaseController {
  public $indexUrl;
  private $postModel;

  public function __construct() {
    parent::__construct();
    $this->postModel = new Post();
    $this->indexUrl = '/'.URL::getAppPath().'/posts';
  }

  public function index() {
    $posts = $this->postModel->findAll();
    Render::view('posts/index', compact('posts'));
  }

  public function show($id) {
    $post = $this->postModel->find($id);
    $messages = $post->messages()->all();;

    if ( empty($post)) return Redirect::to($this->indexUrl);

    Render::view('posts/show', compact('post', 'messages'));
  }

  public function new() {
    $userModel = new User();
    $users = $userModel->findAll()->all();

    Render::view('posts/new', compact('users'));
  }

  public function create() {
    if (!isset($this->request->post)) return Redirect::to($this->indexUrl);

    $id = $this->postModel->save([
      ...$this->request->post,
      'user_id' => Auth::user()->id
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

    if ( empty($post)) return Redirect::to($this->indexUrl);

    Render::view('posts/edit', compact('post'));
  }

  public function update($id) {
    if (!isset($this->request->post)) return Redirect::to($this->indexUrl);

    $post = $this->postModel->find($id);

    if (!isset($post)) return Redirect::to($this->indexUrl);

    $user_id = Auth::user()->id;

    $newData = [
      ...$this->request->post,
      'user_id' => $user_id
    ];

    $post->update($newData);

    if ($post->fails()) {
      Flashify::create([
        'type' => 'danger',
        'message' => implode(',', $post->getErrorMessages()) ,
      ]);
    } else {
      Flashify::create([
        'type' => 'success',
        'message' => 'Post was updated',
      ]);
    }

    return Redirect::to("$this->indexUrl/$id");
  }

  public function delete($id) {
    $affected = $this->postModel->find($id)->delete();

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'Post was deleted',
      ]);
    }

    return Redirect::to($this->indexUrl);
  }
}
