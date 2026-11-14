<?php

namespace App\Http\Controllers;

use App\Model\EngineeringContent;
use App\Imports\NonConformingProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DataTables;
use Auth;

class EngineeringController extends Controller
{
    public function view_enggcontent(){
        $enggcont = EngineeringContent::all();

        return DataTables::of($enggcont)
            ->addColumn('label1', function($enggcontent){
                $result = "";

                if($enggcontent->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($enggcontent){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i> 
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';
                if($enggcontent->status == 1){
                    $result .= '<button class="dropdown-item aChangeEnggContentStat" type="button" enggcontent-id="' . $enggcontent->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeEnggContStat" data-keyboard="false">Unapprove</button>';
                }
                else{
                    $result .= '<button class="dropdown-item aEditEnggContent" type="button" enggcontent-id="' . $enggcontent->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EnggEditContentModal" data-keyboard="false">Edit</button>';
                                        
                    $result .= '<button class="dropdown-item aChangeEnggContentStat" type="button" style="padding: 1px 1px; text-align: center;" enggcontent-id="' . $enggcontent->id . '" status="1" data-toggle="modal" data-target="#modalChangeEnggContStat" data-keyboard="false">Approve</button>';
                }
                            
                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('checkbox', function($enggcontent){
                return '<center><input type="checkbox" class="chkMOD" enggcontent-id="' . $enggcontent->id . '"></center>';
            })
            ->rawColumns(['label1', 'action1', 'checkbox'])
            ->make(true);
    }


    public function add_engg_content(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'maincontent' => ['required', 'string', 'max:255'],
            'subcontenta' => ['string', 'max:255'],
            'subcontentb' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                EngineeringContent::insert([
                    'main_content' => $request->maincontent,
                    'subcontent_a' => $request->subcontenta,
                    'subcontent_b' => $request->subcontentb,
                    'status' => 2,
                    'created_by' => Auth::user()->name,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                DB::commit();

                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0"]);
            }
        }
    }

    // Get Content By Id
    public function get_enggcont_by_id(Request $request){
        $cont = EngineeringContent::where('id', $request->enggcont_id)->get();
        return response()->json(['enggcontent' => $cont]);
    }  

     public function edit_enggcont(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'maincontent' => 'required|string|max:255'. $request->enggcont_id,
            'subcontenta' => 'string|max:255'. $request->enggcont_id,
            'subcontentb' => 'string|max:255'. $request->enggcont_id,
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                EngineeringContent::where('id', $request->enggcont_id)
                ->update(
                [
                'main_content' => $request->maincontent,
                'subcontent_a' => $request->subcontenta,
                'subcontent_b' => $request->subcontentb
                ]);

                DB::commit();

                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0"]);
            }
        }
    }  

    public function change_enggcont_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'enggcont_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                EngineeringContent::where('id', $request->enggcont_id)
                    ->update(
                        [
                            'status' => $request->status,
                        ]
                    );
                DB::commit();
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0"]);
            }  
            
            return response()->json(['result' => 1]);
        }
        else{
            return response()->json(['result' => "0", 'error' => $validator->messages()]);
        }
    }



}   
