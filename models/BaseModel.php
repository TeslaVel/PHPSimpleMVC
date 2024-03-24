<?php
require_once "concerns/FieldsConcern.php";
require_once "concerns/Collection.php";

class BaseModel {
  use FieldsConcern;
  use Collection;

  private $fillables;
  private $tableName;
  protected $object;
  protected $db;

  public function __construct() {
    $this->tableName = strtolower(get_class($this)::$name);
    $this->fillables = get_class($this)::$fillableFields;
    $this->db = Connection::getInstance();
  }

  public function __get($property) {
    if (array_key_exists($property, $this->object)) {
      return $this->object[$property];
    }
    return null;
  }

  public function save($data) {
    $tableName = $this->tableName;

    list($columns, $values, $filteredData) = $this->bindToInsert($this->fillables, $data);

    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

    $stmt = $this->db->prepare($sql);

    foreach ($filteredData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    try {
      $stmt->execute();
      $id = $this->db->lastInsertId();
      $this->object = $this->find($id);
      return $this;
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function find($id) {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    try {
      $stmt->execute();
      $this->object = $stmt->fetch(PDO::FETCH_ASSOC);
      return $this;
      // return new (get_class($this))($data);
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function update($data) {

    $tableName = $this->tableName;
    list($preparedFields, $filteredData) = $this->bindToUpdate($this->fillables, $data);;

    $sql = "UPDATE $tableName SET " . implode(', ', $preparedFields) . " WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

    foreach ($filteredData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    try {
      $stmt->execute();
      $this->object = $this->find($this->id);
      return $stmt->rowCount();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function delete() {
    $tableName = $this->tableName;
    $sql = "DELETE FROM $tableName WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return $stmt->rowCount();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function findAll() {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName";
    $stmt = $this->db->prepare($sql);
    try {
      $stmt->execute();
      $this->collect(
        $stmt->fetchAll(PDO::FETCH_ASSOC)
      );
      return $this;
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function findBy($field, $value) {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName WHERE $field = :value";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':value', $value);

    try {
      $stmt->execute();
      $this->collect(
        $stmt->fetchAll(PDO::FETCH_ASSOC)
      );
      return $this;
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function count() {
    $tableName = $this->tableName;
    $sql = "SELECT COUNT(*) FROM $tableName";
    $stmt = $this->db->prepare($sql);
    try {
      $stmt->execute();
      return $stmt->fetchColumn();
    } catch(PDOException $e) {
      echo "Error de conexión: " . $e;
      exit;
    }
  }

  public function validate($data) {
    // Implementar validación de datos
  }
}
