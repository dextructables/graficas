<?php
require 'autoloader.php';
$f = null;
try {
    $f = new  \Graficas\Providers\FileProvider('datos/visitas.txt');
} catch(Exception $e) {
    echo $e->getMessage();
}


$s = new \Graficas\Providers\ArrayProvider();
$g = new \Graficas\Grafica(800,600, $f);
$g->draw();