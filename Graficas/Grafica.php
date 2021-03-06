<?php
namespace Graficas;

use Graficas\Providers\DataInterface;

abstract class Grafica
{
    protected $width;
    protected $height;
    protected $border;
    protected $padding;
    protected $headerHeight;
    protected $data;
    protected $series;
    protected $bgSettings;
    protected $overlaySettings;
    protected $headerSettings;
    protected $shadowSettings;
    protected $borderSettings;
    protected $fontSettings;
    protected $image;
    protected $graph;
    protected $fontPath;
    protected $chartSettings;

    public function __construct($width, $height, DataInterface $provider)
    {
        $this->width        = $width;
        $this->height       = $height;
        $this->data         = new \pData();
        $this->border       = 1;
        $this->padding      = $this->width * 0.08;
        $this->headerHeight = 0;
        $this->series       = $provider->getData();
        $this->fontPath     = realpath( __DIR__ . '/../librerias/pchart/fonts');


        $this->bgSettings     = array('R'=>0, 'G'=>98, 'B'=>149, 'Alpha' => 55,
                                      'Dash'=>true, 'DashR'=>190, 'DashG'=>203,
                                      'DashB'=>107
                                );

        $this->overlaySettings = array('StartR'=>2, 'StartG'=>71, 'StartB'=>105,
                                       'EndR'=>5, 'EndG'=>100, 'EndB'=>147, 'Alpha'=>50
                                 );

        $this->headerSettings = array('StartR'=>0,'StartG'=>0,'StartB'=>0,
                                      'EndR'=>50,'EndG'=>50,'EndB'=>50,'Alpha'=>100
                                );


        $this->shadowSettings = array('X'=>1,'Y'=>1,'R'=>0,'G'=>0,'B'=>0,'Alpha'=>10);
        $this->borderSettings = array('R'=>0,'G'=>0,'B'=>0);
        $this->fontSettings   = array('FontName'=> $this->fontPath . '/pf_arma_five.ttf', 'FontSize'=>6);

        $this->addSeries();
        $this->setXAxis();
        $this->createImage();
        $this->setDefaultFont();
    }

    public function setBorder($withBorder)
    {
        $this->bgSettings['Dash'] = $withBorder;
    }

    public function save($imagePath)
    {
        $this->drawBackground();
        $this->drawOverlay();
        $this->drawHeader();
        $this->drawBorder();
        $this->setGraphArea();
        $this->drawScale();
        $this->setShadow();
        $this->drawChart();
        $this->image->Render($imagePath); 
    }

    public function setBgColor($R, $G, $B)
    {
        $this->bgSettings['R'] = $R;
        $this->bgSettings['G'] = $G;
        $this->bgSettings['B'] = $B;
    }

    protected function addSeries()
    {
        foreach ($this->series as $serie) {
            $this->data->addPoints($serie['valores'], $serie['titulo']);
        }
    }

    protected function setXAxis()
    {
        $this->data->setAbscissa($this->series[0]['titulo']);
    }

    protected function createImage()
    {
        $this->image = new \pImage($this->width, $this->height ,$this->data);
        $this->image->Antialias = false;
    }

    protected function drawBackground()
    {
        $this->image->drawFilledRectangle(0, 0, $this->width, $this->height, $this->bgSettings);
    }

    protected function drawOverlay()
    {
        $this->image->drawGradientArea(0, 0, $this->width, $this->height, DIRECTION_VERTICAL, $this->overlaySettings);
    }

    protected function drawHeader()
    {
        $this->headerHeight = (int) $this->height / 20;
        $this->image->drawGradientArea(0, 0, $this->width, $this->headerHeight, DIRECTION_VERTICAL, $this->headerSettings);
    }

    protected function drawBorder()
    {
        $this->image->drawRectangle(0, 0 , $this->width - $this->border,
                                   $this->height - $this->border,
                                   $this->borderSettings
                                   );
    }

    protected function setGraphArea()
    {
        $this->image->setGraphArea($this->padding, $this->headerHeight + $this->padding,
                                   $this->width - $this->padding, $this->height - $this->padding);
    }

    protected function drawScale()
    {
        $scaleSettings = array('GridR'=>200,'GridG'=>200,'GridB'=>200,'DrawSubTicks'=>TRUE,'CycleBackground'=>TRUE, 'Mode' => SCALE_MODE_START0);
        $this->image->drawScale($scaleSettings);
    }

    protected function setDefaultFont()
    {
        $this->image->setFontProperties($this->fontSettings);
    }

    protected function setShadow()
    {
        $this->image->setShadow(true, $this->shadowSettings);
    }

    abstract protected function drawChart();

}