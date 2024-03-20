<?php
require_once "BaseModel.php";

class MessageModel extends BaseModel {

  public static $name = 'messages';

  public static $fillableFields = Array(
    'title', 'message', 'created_at', 'updated_at', 'user_id'
  );

  // public function getAllMessages()
  // {
  //   return $this->findAll();
  // }

  public function findById($id)
  {
    return $this->find($id);
  }

  public function createMessage($data)
  {
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