<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = URL::getCurrentRoute();

Router::dispatch($method, $uri);