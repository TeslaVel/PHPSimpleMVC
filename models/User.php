<?php
require_once "BaseModel.php";
class UserModel extends BaseModel {

  public static $name = 'users';

  public static $fillableFields = [
    'first_name', 'last_name', 'created_at', 'updated_at', 'email'
  ];

  public function getAllUsers() {
    return $this->findAll();
  }

  public function findById($id) {
    return $this->find($id);
  }

  public function createUser($first_name, $last_name, $email) {
    $data = array(
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'created_at' =>time(),
      'updated_at' =>time()
    );

    try {
      return $this->save($data);
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e->getMessage();
    }
  }

  public function updateUser($id, $first_name, $last_name, $email) {
    $data = array(
      'first_name' => $first_name,
      'last_name' => $last_name,
      'updated_at' => time(),
    );

    try {
      return $this->update($id, $data);
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      return 0;
    }
  }

  public function deleteUser($id) {
    try {
      return $this->delete($id);
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      return 0;
    }
  }

}
