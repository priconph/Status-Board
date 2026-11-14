<?php

namespace App\Imports;

use App\Model\LotOutDefect;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;


class LotOutDefectsImport implements ToModel
{
    /**
    * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new lotoutdefects([
            'device_name' => $row[0],
            'mode_of_defect' => $row[1],
            'contributing_line' => $row[2],
            'date_detected' => $row[3]
        ]);
    }
}
