<?php

class Render {
  public static function view($path, $params = []) {

    extract($params);
    include_once "views/$path.php";
    include_once "views/layout.php";
  }
}