<?php
require_once "./db/connection.php";

class UserModel extends Connection {

  private $conexion;

  public function __construct() {
    parent::__construct();
    $this->connect();
    $this->conexion = $this->getConnection();
  }

  public function getAllUsers() {
    $sql = "SELECT * FROM users";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserById($id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createUser($first_name, $last_name, $email) {
    $sql = "INSERT INTO users (first_name, last_name, email, created_at, updated_at) VALUES (:first_name, :last_name, :email, :created_at, :updated_at)";
    $stmt = $this->conexion->prepare($sql);

    $data = array(
      ':first_name' => $first_name,
      ':last_name' => $last_name,
      ':email' => $email,
      ':created_at' =>time(),
      ':updated_at' =>time()
    );
    try {
      $stmt->execute($data);
      return $this->conexion->lastInsertId();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e->getMessage();
    }
  }

  public function updateUser($id, $first_name, $last_name, $email) {
    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, updated_at = :updated_at WHERE id = :id";

    $stmt = $this->conexion->prepare($sql);

    $data = array(
      ':first_name' => $first_name,
      ':last_name' => $last_name,
      ':updated_at' => time(),
      ':id' => $id,
    );

    try {
      $stmt->execute($data);
      return $stmt->rowCount();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      return 0;
    }
  }

  public function deleteUser($id) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return $stmt->rowCount();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      return 0;
    }
  }

}

?>
