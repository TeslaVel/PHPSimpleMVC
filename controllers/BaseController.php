<?php

class BaseController {
  public function __construct() {}

  public function renderView($path, $params = []) {
    extract($params);
    include_once "views/$path.php";
    include_once "views/layout.php";
  }

  public function redirectTo($baseUrl) {
    header("Location:  $baseUrl");
    exit;
  }
}