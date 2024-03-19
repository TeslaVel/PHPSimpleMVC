<?php

class Connection {

  public static $host = 'localhost';
  public static $dbname = 'php_test';
  public static $username = 'php_user';
  public static $password = '1234';
  private static $conexion;

  public function __construct() {
  }

  public static function connect() {
    try {
      self::$conexion = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
      self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Error de conexión: " . $e->getMessage();
    }
  }

  public static function getConnection() {
    return self::$conexion;
  }
}