<?php
require_once 'BaseController.php';

class HomeController extends BaseController {
  private $logger;
  public function __construct(Logger $logger = null) {
    $this->logger = $logger;
  }

  public function index() {
    $this->logger->log('Enter to home page');
    Render::view('home/index', []);
  }
}

