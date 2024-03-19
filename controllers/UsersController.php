<?php
require_once 'BaseController.php';

require_once './models/User.php';
require_once './views/helpers/Redirect.php';

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
    $this->renderView('users/index', ['users' => $users]);
  }

  # GET /users/show/:id
  public function show($id) {
    $user = $this->userModel->findById($id);

    if ( empty($user)) {
      return $this->redirectTo($this->indexUrl);
    }

    $this->renderView('users/show', ['user' => $user]);
  }

  # GET /users/new
  public function new() {
    $this->renderView('users/new', []);
  }

  # POST /users/create
  public function create() {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null; // Evitar errores si no existe el campo
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $id = $this->userModel->createUser($first_name, $last_name, $email);

    $this->redirectTo($this->indexUrl);
  }

  # GET users/edit/:id
  public function edit($id) {
    $user = $this->userModel->findById($id);

    $this->renderView('users/edit', ['user' => $user]);
  }

  # POST users/update/:id
  public function update($id) {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null; // Evitar errores si no existe el campo
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $affected = $this->userModel->updateUser($id, $first_name, $last_name, $email);

    $this->redirectTo("$this->indexUrl/$id");
  }

  # POST users/delete/:id
  public function delete($id) {
    $affected = $this->userModel->deleteUser($id);

    $this->redirectTo($this->indexUrl);
  }
}
