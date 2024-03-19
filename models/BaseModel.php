<?php
require_once "./db/connection.php";
require_once "concerns/FieldsConcern.php";

class BaseModel {
  use FieldsConcern;
  protected $db;
  private $fillables;
  private $tableName;

  public function __construct() {
    $this->tableName = strtolower(get_class($this)::$name);
    $this->fillables = get_class($this)::$fillableFields;

    if (!$this->db) {
      Connection::connect();
      $this->db = Connection::getConnection();
    }
  }

  public function save($data) {
    $tableName = $this->tableName;

    list($columns, $values, $filteredData) = $this->bindToInsert($this->fillables, $data);

    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

    $stmt = $this->db->prepare($sql);

    foreach ($filteredData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
    return $this->db->lastInsertId();
  }

  public function find($id) {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($id, $data) {

    $tableName = $this->tableName;
    list($preparedFields, $filteredData) = $this->bindToUpdate($this->fillables, $data);;

    $sql = "UPDATE $tableName SET " . implode(', ', $preparedFields) . " WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    foreach ($filteredData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function delete($id) {
    $tableName = $this->tableName;
    $sql = "DELETE FROM $tableName WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
  }

  public function findAll() {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findBy($field, $value) {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName WHERE $field = :value";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function count() {
    $tableName = $this->tableName;
    $sql = "SELECT COUNT(*) FROM $tableName";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function validate($data) {
    // Implementar validación de datos
  }
}
