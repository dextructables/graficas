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
        $rowCounter = 0;
        $data       = array();
        $fileHandle = fopen($this->filePath, 'r');

        while (($serie = fgetcsv($fileHandle)) !== false) {

            $data[$rowCounter] = array('titulo' => $serie[0], 'valores' => array_slice($serie,1));
            $rowCounter++;
  
        }

        fclose($fileHandle);

        return $data;
    }
}