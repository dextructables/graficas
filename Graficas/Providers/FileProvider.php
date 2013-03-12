<?php
namespace Graficas\Providers;

use Graficas\Exception\InvalidFileException;

class FileProvider implements DataInterface
{
    protected $filePath;

    public function __construct($filePath)
    {
        if (!is_file($filePath) || !is_readable($filePath)) {
            throw new InvalidFileException('El archivo proporcionado no existe ó no es válido', 1);  
        }

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