<?php
require_once 'BaseController.php';

class UsersController extends BaseController {
  use Redirect;

  private $userModel;
  public $indexUrl;

  public function __construct() {
    parent::__construct();
    $this->userModel = new UserModel();
    $this->indexUrl = '/'.Config::getAppPath().'/users';
  }

  # GET /users
  public function index() {
    $users = $this->userModel->getAllUsers();
    Render::view('users/index', ['users' => $users]);
  }

  # GET /users/show/:id
  public function show($id) {
    $user = $this->userModel->findById($id);

    if ( empty($user))  return Redirect::to($this->indexUrl);

    Render::view('users/show', ['user' => $user]);
  }

  # GET users/edit/:id
  public function edit($id) {
    $user = $this->userModel->findById($id);

    Render::view('users/edit', ['user' => $user]);
  }

  # POST users/update/:id
  public function update($id) {
    $data = $_POST['user'];

    $affected = $this->userModel->updateUser($id, $data);

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
    $affected = $this->userModel->deleteUser($id);

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'User was deleted',
      ]);
    }

    Redirect::to($this->indexUrl);
  }
}
