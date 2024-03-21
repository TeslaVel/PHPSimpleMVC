<?php

class Connection {
  public static $host = 'localhost';
  public static $dbname = 'php_test';
  public static $username = 'php_user';
  public static $password = '1234';
  private static $instance = null;
  private $connection;

  private function __construct() {
    try {
        $this->connection = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit;
    }
  }

  public static function getInstance() {
    if (self::$instance === null) {
        self::$instance = new Connection();
    }
    return self::$instance->getConnection();
  }

  public function getConnection() {
      return $this->connection;
  }
}