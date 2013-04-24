<?php
require './librerias/idiorm/idiorm.php';
require 'autoloader.php';

$f = null;

try {
    $f = new  \Graficas\Providers\FileProvider('datos/visitas.txt');
} catch(Exception $e) {
    echo $e->getMessage();
}


$ap = new \Graficas\Providers\ArrayProvider();
$db = new \Graficas\Providers\DatabaseProvider('datos-visitas');
$g = new \Graficas\GraficaBarras(700, 500, $f);
$g->save('img/algo.png');