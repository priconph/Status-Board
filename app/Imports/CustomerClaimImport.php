<?php

namespace App\Imports;

use App\Model\CustomerClaim;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;


class CustomerClaimImport implements ToModel
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
            'customer' => $row[2],
            'date_detected' => $row[3]
        ]);
    }
}
