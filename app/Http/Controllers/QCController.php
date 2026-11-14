<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\ATKSRecordsExportView;
use Carbon\Carbon;

use App\QCStatBoardDB;
use DataTables;

class QCController extends Controller
{
    public function index(Request $request)
    {
        $QCContent;
        if ($request->ajax()) {
            $QCContent = QCStatBoardDB::all();
            return DataTables::of($QCContent)
                    ->addIndexColumn()

                    ->addColumn('action',function($row){

                    $btn = '<p align="center"><a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEnggCont">Return Details</a></p>';

                    return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('qc_content')->with('qc_content');
    }
}
