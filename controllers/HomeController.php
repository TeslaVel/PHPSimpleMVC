<?php
require_once 'BaseController.php';

class HomeController extends BaseController {
  public function __construct() {}

  public function index() {
    Render::view('home/index', []);
  }
}

