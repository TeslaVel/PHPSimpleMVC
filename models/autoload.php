<?php

function modelsAutoload($className) {
    // Obtener la lista de archivos en el directorio 'validators/'
    $files = scandir(__DIR__ . '/');

    foreach ($files as $file) {
      if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        require_once "models/$file";
      }
    }
}

// Registrar la función de autoloading personalizada
spl_autoload_register('modelsAutoload');