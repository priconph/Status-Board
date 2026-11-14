<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\ATKSRecordsExportView;
use Carbon\Carbon;

use App\ProductionStatBoardDB;
use DataTables;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        $ProdContent;
        if ($request->ajax()) {
            $ProdContent = ProductionStatBoardDB::all();
            return DataTables::of($ProdContent)
                    ->addIndexColumn()

                    ->addColumn('action',function($row){

                    $btn = '<p align="center"><a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEnggCont">Return Details</a></p>';

                    return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('production_content')->with('production_content');
    }
}
