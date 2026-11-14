<?php

namespace App\Imports;

use App\Model\ListOfDocuments;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;


class ListofDocumentsImport implements ToModel
{
    /**
    * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new lotoutdefects([
            'document_no' => $row[0],
            'document_title' => $row[1],
            'document_category' => $row[3],
            'revision_details' => $row[2]
            

        ]);
    }
}
