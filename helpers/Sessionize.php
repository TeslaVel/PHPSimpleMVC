<?php

class Session {
  public static function create($cookie_name, $params = []) {
    $expirationDate = time() + 3600 * 1; // 1 hora

    $jsonData = json_encode($params);
    $encodedData = base64_encode($jsonData);
    setcookie($cookie_name, $encodedData, $expirationDate, '/');
  }

  public static function get($cookie_name) {
    // Check if cookie exists
    if (!isset($_COOKIE[$cookie_name])) {
      return null;
    }

    // Decode and return data
    try {
      $encodedData = $_COOKIE[$cookie_name];
      $jsonData = base64_decode($encodedData);
      return json_decode($jsonData, true); // Decode as associative array
    } catch (Exception $e) {
      // Handle potential errors during decoding
      return null;
    }
  }

  public static function check($cookie_name) {
    return isset($_COOKIE[$cookie_name]);
  }
  public static function destroy($cookie_name) {
    setcookie($cookie_name, '', time() - 3600, '/');
    unset($_COOKIE[$cookie_name]);
  }
}