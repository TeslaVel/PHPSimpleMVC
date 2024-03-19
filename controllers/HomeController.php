<?php
require_once 'BaseController.php';

class HomeController extends BaseController {
  public function __construct() {}

  public function index() {
    $this->renderView('home/index', []);
  }
}

