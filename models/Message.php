<?php
require_once "BaseModel.php";

class MessageModel extends BaseModel {

  public static $name = 'messages';

  public static $fillableFields = Array(
    'title', 'message', 'created_at', 'updated_at', 'user_id'
  );

  // public static $filableFk = [
  //   'user_id',
  // ];

  // protected $protected_fields = ['id'];
  // protected $primary_key = 'id';

  public function getAllMessages()
  {
    return $this->findAll();
  }

  public function findById($id)
  {
    // $sql = "SELECT * FROM messages WHERE id = :id";
    // $stmt = self::getConnection()->prepare($sql);
    // $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    // $stmt->execute();
    // return $stmt->fetch(PDO::FETCH_ASSOC);

    return $this->find($id);
  }

  public function createMessage($data)
  {
    // $sql = "INSERT INTO messages (title, message, user_id, created_at, updated_at) VALUES (:title, :message, :user_id, :created_at, :updated_at)";

    // $stmt = self::getConnection()->prepare($sql);
    // $data = array(
    //   'title' => $title,
    //   'message' => $message,
    //   'user_id' => $user_id,
    //   'created_at' => time(),
    //   'updated_at' => time()
    // );

    try {
      return $this->save($data);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      exit;
    }
  }

  public function updateMessage($id, $data)
  {
    try {
      return $this->update($id, $data);
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function deleteMessage($id)
  {
    try {
      return $this->delete($id);
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      return 0;
    }
  }
}