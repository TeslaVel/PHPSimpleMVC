<?php

require_once "./db/connection.php";

class MessageModel extends Connection
{
  private $conexion;

  public function __construct()
  {
    parent::__construct();
    $this->connect();
    $this->conexion = $this->getConnection();
  }

  public function getAllMessages()
  {
    $sql = "SELECT * FROM messages";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getMessageById($id)
  {
    $sql = "SELECT * FROM messages WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createMessage($title, $message, $user_id)
  {
    $sql = "INSERT INTO messages (title, message, user_id, created_at, updated_at) VALUES (:title, :message, :user_id, :created_at, :updated_at)";

    $stmt = $this->conexion->prepare($sql);
    $data = array(
      ':title' => $title,
      ':message' => $message,
      ':user_id' => $user_id,
      ':created_at' => time(),
      ':updated_at' => time()
    );
    try {
      $stmt->execute($data);
      return $this->conexion->lastInsertId();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return 0;
    }
  }

  public function updateMessage($id, $title, $message_body, $user_id)
  {
    $sql = "UPDATE messages SET title = :title, message = :message, user_id = :user_id, updated_at = :updated_at WHERE id = :id";

    $stmt = $this->conexion->prepare($sql);

    $data = array(
      ':title' => $title,
      ':message' => $message_body,
      ':user_id' => $user_id,
      ':updated_at' => time(),
      ':id' => $id
    );

    try {
      $stmt->execute($data);
      return $stmt->rowCount();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      return 0;
    }
  }

  public function deleteMessage($id)
  {
    $sql = "DELETE FROM messages WHERE id = :id";
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