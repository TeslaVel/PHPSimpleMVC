<?php
require_once "concerns/Renderize.php";
require_once './helpers/Redirect.php';

require_once './models/Message.php';
require_once './models/User.php';
require_once './models/Post.php';

class BaseController {
  public function __construct() {}
}