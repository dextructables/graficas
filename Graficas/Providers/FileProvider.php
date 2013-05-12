<?php
namespace Graficas\Providers;

class FileProvider implements DataInterface
{
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getData()
    {

        $data       = array();
        $fileHandle = fopen($this->filePath, 'r');

        while (($serie = fgetcsv($fileHandle)) !== false) {

            $data[] = array('titulo' => $serie[0], 'valores' => array_slice($serie,1));
        }

        fclose($fileHandle);

        return $data;
    }
}