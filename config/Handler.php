<?php
$method = $_SERVER['REQUEST_METHOD'];
$uri = Config::getCurrentRoute();

Router::dispatch($method, $uri);