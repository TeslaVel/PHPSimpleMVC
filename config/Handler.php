<?php
$found = false;

function instantiate($controllerDir, $controllerName, $actionName, $matches) {
  include_once $controllerDir;
  $logger = new ActionLogger();

  $controller = new $controllerName($logger);

  if (!isset($actionName)) {
    return $controller->index();
  }

  if (!method_exists($controller, $actionName)) {
    echo "Action '$actionName' not found in controller '$controllerName'";
    return;
  }

  if (isset($matches) && count($matches) > 1) { // Checkeo si hay parametros
    $parameters = array_slice($matches, 1); // Extraigo esos parametros excluyendo el match de la ruta
    $controller->$actionName(...array_values($parameters)); // Paso los parametros de forma individual
  } else {
    $controller->$actionName();
  }
}

foreach ($routes as $route => $controllerAction) {
  $route = preg_replace('/\{(\w+)\}/', '(?<$1>\d+)', $route);

  if (preg_match("@^$route$@i", Config::getCurrentRoute(), $matches)) {
    if (isset($controllerAction['middleware'])) {
      $middlewareName = $controllerAction['middleware'];
      // call_user_func($middlewareName."::handle()");
      $middlewareName::handle();

      list($controllerName, $actionName) = explode('@', $controllerAction['action']);
    } else {
      list($controllerName, $actionName) = explode('@', $controllerAction);
    }
    $fisicalDir = Config::getRootPath()."/controllers/$controllerName.php";
    $controllerDir = "controllers/$controllerName.php";

    if (file_exists($fisicalDir)) {
      instantiate($controllerDir, $controllerName, $actionName, $matches);
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