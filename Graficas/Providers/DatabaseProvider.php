<?php
namespace Graficas\Providers;
use \ORM;

class DatabaseProvider implements DataInterface
{
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;

        ORM::configure('mysql:host=localhost;dbname=dextructables');
        ORM::configure('username', 'tutoriales');
        ORM::configure('password', 'topsecret');
    }

    public function getData()
    {
        $data = array();

        $data[0]['titulo'] = 'Meses';

        $months = ORM::for_table($this->tableName)->distinct()->select('month')->find_many();

        foreach ($months as $month) {
             $data[0]['valores'][] = $month->month;
        }

        $years = ORM::for_table($this->tableName)->distinct()->select('year')->find_many();

        foreach ($years as $year) {
            $records = ORM::for_table($this->tableName)->where('year', $year->year)->find_many();
            $visitas = array_map(function($i){return $i->visits; }, $records);
            $data[] = array('titulo' => $year->year, 'valores' => $visitas);
        }

        return $data;

    }
}