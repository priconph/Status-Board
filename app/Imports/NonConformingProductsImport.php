<?php

namespace App\Imports;

use App\Model\EngineeringContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;

class NonConformingProductsImport implements ToModel
{
    /**
    * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new nonconfproducts([
        	'content_date' => $row[0],
            'product_name' => $row[1],
            'po_number' => $row[2],
            'problem' => $row[3],
            'ptis_ng_report_number' => $row[4],
            'status_disposition' => $row[5]
        ]);
    }

}
