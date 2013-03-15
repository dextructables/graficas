<?php
namespace Graficas;

class GraficaBarras extends Grafica
{
    public function __construct($width, $height, $provider)
    {
        parent::__construct($width, $height, $provider);
        
        $this->chartSettings  = array('Surrounding'=>-30,'InnerSurrounding'=>30,'Interleave'=>0.2,
                                      'Draw0Line' => true, 'DisplayValues' => true
                                );
    }

    protected function drawChart()
    {
        $this->image->drawBarChart($this->chartSettings); 
    }
}