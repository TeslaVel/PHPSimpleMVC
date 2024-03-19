<?php
class Config {
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
