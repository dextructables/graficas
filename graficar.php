<?php
require './librerias/idiorm/idiorm.php';
require 'autoloader.php';

header('Content-Type: application/json; charset=utf-8');

$graphType    = (int) $_GET['type'];
$dataSource   = (int) $_GET['source'];

$dataProviderClass = null;
$dataProvider      = null;
$graph             = null;
$graphClass        = '';
$rutaImagen        = 'img/grafica.png';

$dataProviders = array(1 => '\\Graficas\\Providers\\ArrayProvider',
                       2 => '\\Graficas\\Providers\\DatabaseProvider',
                       3 => '\\Graficas\\Providers\\FileProvider'
                       );

$graphTypes    = array(1 => '\\Graficas\\GraficaBarras',
                       2 => '\\Graficas\\GraficaLineas'
                       );

$args          = array(1 => array(),
                       2 => array('datos-visitas'),
                       3 => array('datos/visitas.txt')
                      );

$results = array('error' => 0, 'message' => '', 'path' => '');

if (!array_key_exists($graphType, $graphTypes) || !array_key_exists($dataSource, $dataProviders)) {
    $results['error']   = 1;
    $results['message'] = 'Fuente de datos/tipo de gráfica inválidos';
}

if ($results['error'] == 0) {

    $graphClass        = $graphTypes[$graphType];
    $dataProviderClass = new ReflectionClass($dataProviders[$dataSource]);
    $dataProvider      = $dataProviderClass->newInstanceArgs($args[$dataSource]);
    $graph             = new $graphClass(700, 400, $dataProvider);
    $graph->save($rutaImagen);
    
    $results['message'] = 'imagen generada correctamente';
    $results['path']    = $rutaImagen . '?nocache=' . time();
}

echo json_encode($results);