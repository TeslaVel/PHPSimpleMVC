<?php
require_once './models/User.php';
class Auth {
  public $user;

  public static function user() {
    if (Cookie::getCookie(Config::$COOKIE_NAME) == NULL) {
      return null;
    }

    $user_id = Cookie::getCookie(Config::$COOKIE_NAME)['user_id'];
    $tableName = User::$name;
    $con = Connection::getInstance();
    $sql = "SELECT * FROM $tableName WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function check() {
    return self::user() !== null;
  }

  public static function store($params = []) {
    Cookie::store(Config::$COOKIE_NAME, $params);
  }

  public static function destroy($params = []) {
    Cookie::destroy(Config::$COOKIE_NAME);
  }
}
