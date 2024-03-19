<?php
require_once './models/User.php';
require_once './views/helpers/RenderView.php';
require_once './views/helpers/Redirect.php';

class UsersController extends UserModel {
    public $indexUrl;

    public function __construct() {
      parent::__construct();
      $this->indexUrl = '/'.Config::getAppPath().'/users';
    }

    public function index() {
      // Mostrar la lista de usuarios
      $users = $this->getAllUsers();
      RenderView::render('users/index', ['users' => $users]);
    }

    public function show($id) {
      // Mostrar un usuario específico
      $user = $this->getUserById($id);

      if ( empty($user)) {
        return Redirect::redirectTo($this->indexUrl);
      }

      RenderView::render('users/show', ['user' => $user]);
    }

    public function new() {
      // Mostrar el formulario de creación de usuario
      RenderView::render('users/new', []);
    }

    public function create() {
      $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null; // Evitar errores si no existe el campo
      $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
      $email = isset($_POST['email']) ? $_POST['email'] : null;

      $id = $this->createUser($first_name, $last_name, $email);

      Redirect::redirectTo($this->indexUrl);
    }

    public function edit($id) {
      $user = $this->getUserById($id);
      
      RenderView::render('users/edit', ['user' => $user]);
    }

    public function update($id) {
      // Actualizar un usuario

      $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null; // Evitar errores si no existe el campo
      $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
      $email = isset($_POST['email']) ? $_POST['email'] : null;

      $affected = $this->updateUser($id, $first_name, $last_name, $email);

      Redirect::redirectTo("$this->indexUrl/$id");
    }

    public function delete($id) {
      // Eliminar un usuario
      $affected = $this->deleteUser($id);

      Redirect::redirectTo($this->indexUrl);
    }
}
?>
