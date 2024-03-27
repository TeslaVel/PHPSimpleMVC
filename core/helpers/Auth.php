<?php

require_once 'models/User.php';
class Auth {
  public static $user;

  public static function user() {
    if (Cookie::getCookie(Config::$COOKIE_NAME) == NULL) {
      return null;
    }

    if (self::$user) { return self::$user; }

    $user_id = Cookie::getCookie(Config::$COOKIE_NAME)['user_id'];
    self::$user = (new User)->find($user_id);
    return self::$user;
  }

  public static function check() {
    return self::user() !== null;
  }

  public static function store(User $user) {
    self::$user = $user;
    Cookie::store(Config::$COOKIE_NAME, ['user_id' => $user->id]);
  }

  public static function destroy($params = []) {
    Cookie::destroy(Config::$COOKIE_NAME);
    self::$user = null;
  }
}
