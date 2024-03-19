<?php
require_once './models/User.php';

class HomeController  extends UserModel {
  public $mivar;
  public function __construct() {
    $this->mivar = '3';
  }

  public function index() {
    include_once 'views/home/index.php';
  }
}
?>
