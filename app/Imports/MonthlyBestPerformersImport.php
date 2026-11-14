<?php

namespace App\Imports;

use App\Model\MonthlyBestPerformer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;

class MonthlyBestPerformersImport implements ToModel
{
    /**
    * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new lotoutdefects([
            'employee_name' => $row[0],
            'award_category' => $row[1],
            'content_month' => $row[2],
        ]);
    }
}
