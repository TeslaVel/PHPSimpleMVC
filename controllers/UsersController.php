<?php

class UsersController extends BaseController {

  private $userModel;
  public $indexUrl;

  public function __construct() {
    parent::__construct();
    $this->userModel = new User();
    $this->indexUrl = '/'.URL::getAppPath().'/users';
  }

  # GET /users
  public function index() {
    $users = $this->userModel->findAll()->all();
    Render::view('users/index', compact('users'));
  }

  # GET /users/show/:id
  public function show($id) {
    $user = $this->userModel->find($id);

    if ( empty($user)) return Redirect::to($this->indexUrl);

    Render::view('users/show', compact('user'));
  }

  # GET users/edit/:id
  public function edit($id) {
    $user = $this->userModel->find($id);

    Render::view('users/edit', compact('user'));
  }

  # POST users/update/:id
  public function update($id) {
    if (!isset($this->request->user)) return Redirect::to($this->indexUrl);

    $user = $this->userModel->find($id);

    $affected = $user->update($this->request->user);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'User was updated',
      ]);
    }

    Redirect::to("$this->indexUrl/$id");
  }

  # POST users/delete/:id
  public function delete($id) {
    $affected = $this->userModel->find($id)->delete();

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'User was deleted',
      ]);
    }

    Redirect::to($this->indexUrl);
  }
}
