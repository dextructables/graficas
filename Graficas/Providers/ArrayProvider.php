<?php
namespace Graficas\Providers;

class ArrayProvider implements DataInterface
{
    public function getData()
    {

        return array(

            array(
                'titulo' => 'Meses',
                'valores' => array('Enero','Febrero','Marzo','Abril','Mayo','Junio',
                                   'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')
                ),
            array(
                'titulo'  => '2011',
                'valores' => array(20,35,52,50,75,80,87,95,135,214,250,310)
                ),
            array(
                'titulo'  => '2012',
                'valores' => array(325,387,340,402,433,468,527,547,621,646,750,801)
                )
        );

    }
}