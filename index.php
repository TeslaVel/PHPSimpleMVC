<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/config.php';

$uri = $_SERVER['REQUEST_URI'];
$found = false;

foreach ($routes as $route => $controllerAction) {
  if (preg_match("@^$route$@i", Config::getCurrentRoute(), $matches)) {
    $controllerName = explode('@', $controllerAction)[0];
    $actionName = explode('@', $controllerAction)[1];
    $fisicalDir = Config::getRootPath()."/controllers/$controllerName.php";
    $controllerDir = "controllers/$controllerName.php";

    if (file_exists($fisicalDir)) {
      include_once $controllerDir;

      $controller = new $controllerName();

      if (isset($actionName)) {
        if (method_exists($controller, $actionName)) {
          if (isset($matches) && count($matches) > 1) { // Checkeo si hay parametros
            $parameters = array_slice($matches, 1); // Extraigo esos parametros excluyendo el match de la ruta
            $controller->$actionName(...array_values($parameters)); // Paso los parametros de forma individual
          } else {
            $controller->$actionName();
          }
        } else {
          echo "Action '$actionName' not found in controller '$controllerName'";
        }
      } else {
        $controller->index();
      }

      $found = true;
      break;
    } else {
      echo "<br>Controller file not found: $fisicalDir";
    }
  }
}

if (!$found) {
  echo "<br>Invalid route";
}