<?php
namespace Graficas;

class GraficaLineas extends Grafica
{
    public function __construct($width, $height, $provider)
    {
        parent::__construct($width, $height, $provider);
        
        $this->chartSettings  = array('DisplayValues'=>true ,'DisplayColor'=>DISPLAY_AUTO);
    }

    protected function drawChart()
    {
        $this->image->drawLineChart($this->chartSettings); 
    }
}