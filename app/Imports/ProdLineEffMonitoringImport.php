<?php

namespace App\Imports;

use App\Model\ProdLineEffMonitoring;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;

class ProdLineEffMonitoringImport implements ToModel
{
    /**
    * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new prodlineeffmon([
            'line' => $row[0],
            'actual_efficiency' => $row[1],
            'result' => $row[2],
            'target' => $row[3],
            'content_month' => $row[4]
        ]);
    }
}
