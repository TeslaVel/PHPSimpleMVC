<?php

class Config {
  public static $COOKIE_NAME = 'a2jd54a7e';

  public static function getRootPath() {
    $root = dirname(__FILE__);
    return str_replace('/config', "",  $root);
  }

  public static function getAppPath() {
    return 'PHPSimpleMVC';
  }

  public static function getCurrentPath() {
    $uri = $_SERVER['REQUEST_URI'];
    $url = explode('?', $uri)[0];
    $dataRoute = explode("/", str_replace(".php", "", $url));
    return end($dataRoute);
  }

  public static function getCurrentRoute() {
    $uri = $_SERVER['REQUEST_URI'];
    $url = explode('?', $uri)[0];
    return str_replace('/'.self::getAppPath(), "", $url);
  }
}
require_once "db/Connection.php";
require_once 'config/Logger.php';
require_once 'config/ActionLogger.php';
require_once "helpers/Cookie.php";
require_once 'helpers/Flashify.php';
require_once 'helpers/Auth.php';
require_once 'helpers/Redirect.php';
require_once 'helpers/Renderize.php';
require_once 'config/Router.php';
require_once 'config/Filters.php';
require_once 'config/Routes.php';


