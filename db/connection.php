<?php

class Connection {

  private $host;
  private $dbname;
  private $username;
  private $password;
  private $conexion;

  public function __construct(/* $host, $dbname, $username, $password */) {
    $this->host = 'localhost';
    $this->dbname = 'php_test';
    $this->username = 'php_user';
    $this->password = '1234';
  }

  public function connect() {
    try {
      $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
      // $this->conexion = new PDO('sqlite:../database.sqlite');
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Error de conexión: " . $e->getMessage();
    }
  }

  public function getConnection() {
    return $this->conexion;
  }

}

?>
