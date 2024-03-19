<?php
class RenderView {
  public static function render($path, $params) {
    extract($params);
    include_once "views/$path.php";
  }
}
?>