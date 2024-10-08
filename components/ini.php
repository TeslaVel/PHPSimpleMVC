<?php

function componentsAutoload($className) {
    $files = scandir(__DIR__ . '/');

    require_once "HelperComponent.php";

    foreach ($files as $file) {
      if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        require_once "$file";
      }
    }
}

// Registrar la función de autoloading personalizada
spl_autoload_register('componentsAutoload');