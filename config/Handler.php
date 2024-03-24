<?php
$found = false;

function instantiate($controllerName, $actionName, $matches) {
  $controllerPath = "controllers/$controllerName.php";

  include_once $controllerPath;

  $logger = new ActionLogger();

  if (!isset($actionName)) return $controller->index();

  $controller = new $controllerName($logger);

  if (!method_exists($controller, $actionName)) {
    echo "Action '$actionName' not found in controller '$controllerName'";
    exit;
  }

  if (isset($matches) && count($matches) > 1) { // Checkeo si hay parametros
    $parameters = array_slice($matches, 1); // Extraigo esos parametros excluyendo el match de la ruta
    $controller->$actionName(...array_values($parameters)); // Paso los parametros de forma individual
  } else {
    $controller->$actionName();
  }

  return true;
}

function checkIfExistsContorller($controllerName, $actionName, $matches) {
  $controllerDir = Config::getRootPath()."/controllers/$controllerName.php";

  if (file_exists($controllerDir)) {
    instantiate($controllerName, $actionName, $matches);
    return true;
  }

  echo "<br>Controller file not found: $controllerDir";
}

foreach ($routes as $route => $controllerAction) {
  $route = preg_replace('/\{(\w+)\}/', '(?<$1>\d+)', $route);
  if (preg_match("@^$route$@i", Config::getCurrentRoute(), $matches)) {
    if (isset($controllerAction['middleware'])) {
      $middlewareName = $controllerAction['middleware'];
      $middlewareName::handle();

      list($controllerName, $actionName) = explode('@', $controllerAction['action']);
    } else {
      list($controllerName, $actionName) = explode('@', $controllerAction);
    }

    $controllerDir = Config::getRootPath()."/controllers/$controllerName.php";

    $found = checkIfExistsContorller($controllerName, $actionName, $matches);
  }
}

if (!$found) {
  echo "<br>Invalid route";
}