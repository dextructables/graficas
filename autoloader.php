<?php
/* Autoloader para las clases de pGraph */
spl_autoload_register(function($class){
    $file = __DIR__ . '/librerias/pchart/class/' . $class . '.class.php';
    if (file_exists($file)) {
        require $file;
    }
});

/* Autoloader para nuestras clases que usan Namespaces */
spl_autoload_register(function($class){
   $class = str_replace('\\', '/', $class);
   $file = __DIR__ . '/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});