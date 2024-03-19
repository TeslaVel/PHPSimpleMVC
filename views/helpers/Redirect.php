<?php
class Redirect {
  public static function redirectTo($baseUrl) {
    header("Location:  $baseUrl");
    exit;
  }
}
?>