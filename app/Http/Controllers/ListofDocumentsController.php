<?php

namespace App\Http\Controllers;

use App\Model\ListOfDocuments;
use App\Model\SetInterval;
use App\User;
use App\Imports\ListofDocumentsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DataTables;
use Auth;
use Mail;

class ListofDocumentsController extends Controller
{
    public function view_listofdocs(){
        $listofdocs = ListOfDocuments::where('status', '!=', 3);

        return DataTables::of($listofdocs)
            ->addColumn('label1', function($listofdocuments){
                $result = "";

                if($listofdocuments->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($listofdocuments){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i> 
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';
                if($listofdocuments->status == 1){

                    $result .= '<button class="dropdown-item aEditListOfDocsContent" type="button" listofdocuments-id="' . $listofdocuments->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#ListOfDocsEditContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeListOfDocsContentStat" type="button" listofdocuments-id="' . $listofdocuments->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeListOfDocsContentStat" data-keyboard="false">Disapprove</button>';

                    $result .= '<button class="dropdown-item aChangeListOfDocsContentStat" type="button" listofdocuments-id="' . $listofdocuments->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeListOfDocsContentStat" data-keyboard="false">Delete</button>';

                    }                    
                }
                else{
                    $result .= '<button class="dropdown-item aEditListOfDocsContent" type="button" listofdocuments-id="' . $listofdocuments->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#ListOfDocsEditContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {                    

                        $result .= '<button class="dropdown-item aChangeListOfDocsContentStat" type="button" style="padding: 1px 1px; text-align: center;" listofdocuments-id="' . $listofdocuments->id . '" status="1" data-toggle="modal" data-target="#modalChangeListOfDocsContentStat" data-keyboard="false">Approve</button>';

                        $result .= '<button class="dropdown-item aChangeListOfDocsContentStat" type="button" listofdocuments-id="' . $listofdocuments->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeListOfDocsContentStat" data-keyboard="false">Delete</button>';                        
                    }
                }
                            
                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('list_of_docs', function($listofdocuments){
                $docs_list = '';

                if($listofdocuments->document_category == 1){
                    $docs_list = 'Work Instruction (A3)';
                }
                else if($listofdocuments->document_category == 2){
                    $docs_list = 'Point Panel (A3)';
                }
                else if($listofdocuments->document_category == 3){
                    $docs_list = 'PQS Document';
                }             
                return $docs_list;
            })             
            ->addColumn('checkbox', function($listofdocuments){
                return '<center><input type="checkbox" class="chkMOD" listofdocuments-id="' . $listofdocuments->id . '"></center>';
            })
            ->rawColumns(['label1', 'action1', 'checkbox','list_of_docs'])
            ->make(true);
    }

    public function add_listofdocs(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'documenttype' => ['required', 'string', 'max:255'],
            'documentno' => ['string', 'max:255'],
            'documenttitle' => ['string', 'max:255'], 
            'revisiondetails' => ['string', 'max:255'], 
            'start_date' => ['string', 'max:255'], 
            'expiry_date' => ['string', 'max:255'], 
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                ListOfDocuments::insert([
                    'document_no' => $request->documentno,
                    'document_title' => $request->documenttitle,
                    'document_category' => $request->documenttype,
                    'revision_details' => $request->revisiondetails,
                    'start_date' => $request->start_date,
                    'expiry_date' => $request->end_date,                     
                    'status' => 2,
                    'date_uploaded' => date('Y-m-d'),
                    'created_by' => Auth::user()->id,
                    'last_updated_by' => Auth::user()->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')                   
                ]);

                DB::commit();

                $pending = ListOfDocuments::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 2)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_listofdocs', $data, function($message) use($recipients){
                        $message->to($recipients)->subject('Status Board System Content Approval Notification');

                    });

                    return response()->json([
                        'result' => 1
                    ]);

                }else{

                    return response()->json([
                        'result' => 0
                    ]);            
                }        
                
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0"]);
            }
        }
    }

    public function setinterval_listofdocs(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'carousel_slide' => ['required', 'string', 'max:255'],
            'slide_interval' => ['numeric'],       
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            $carouselslide = SetInterval::where('carousel', $request->carousel_slide)->first();

            if ($carouselslide == null) {
                try{
                    SetInterval::insert([
                        'carousel' => $request->carousel_slide,
                        'data_interval' => $request->slide_interval,
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
            }else{
                try{
                    SetInterval::where('carousel', $request->carousel_slide)->update([
                        'data_interval' => $request->slide_interval,
                        'updated_at' => date('Y-m-d H:i:s')            
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
    } 

    public function get_listofdocs_by_id(Request $request){
        $listofdocscont = ListOfDocuments::where('id', $request->listofdocs_id)->get();
        return response()->json(['listofdocuments' => $listofdocscont]);
    }

    public function edit_listofdocs(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'listofdocs_id' => 'required|string|max:255'. $request->listofdocs_id,
            'documentno' => 'string|max:255'. $request->listofdocs_id,
            'documenttitle' => 'string|max:255'. $request->listofdocs_id,
            'revisiondetails' => 'string|max:255'. $request->listofdocs_id,
            'start_date' => 'string|max:255'. $request->listofdocs_id,
            'expiry_date' => 'string|max:255'. $request->listofdocs_id,
            'documenttype' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                ListOfDocuments::where('id', $request->listofdocs_id)
                ->update(
                [
                'document_no' => $request->documentno,
                'document_title' => $request->documenttitle,                  
                'document_category' => $request->documenttype,
                'revision_details' => $request->revisiondetails,
                'start_date'=> $request->start_date,
                'expiry_date'=> $request->end_date, 
                'last_updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')      
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
    
    public function change_listofdocs_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'listofdocs_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                ListOfDocuments::where('id', $request->listofdocs_id)
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

    public function get_listofdocs_by_stat(Request $request){
        $listofdocs = ListOfDocuments::where('status', $request->status)->get();
        $perbatchnumber = ListOfDocuments::select('batch_number')->where('status', 2)->distinct('batch_number')->get();
        return response()->json([
            'listofdocs' => $listofdocs,
            'perbatchnumber' => $perbatchnumber
        ]);
    }

    public function import_listofdocs(Request $request)
    {
        DB::beginTransaction();
        try{

            if(request()->file('import_file_listofdocs')){
                $listofdocs = Excel::toCollection(new ListofDocumentsImport, request()->file('import_file_listofdocs'));

                
                if ($listofdocs != null) {

                    $data = ListOfDocuments::where('batch_number', '!=', null)->orderBy('batch_number', 'desc')->first();
                    $batch_number = 1;

                    if ($data != null) {
                        $batch_number = $data->batch_number + 1;
                    } 
                    for($index = 2; $index < count($listofdocs[0]); $index++){

                        $doc_cat = '';

                        if ($listofdocs[0][$index][3] == 'Work Instruction (A3)') {
                            $doc_cat = 1;
                        }else if ($listofdocs[0][$index][3] == 'Point Panel (A3)') {
                            $doc_cat = 2;
                        }else{
                            $doc_cat = 3;
                        }  
                        ListOfDocuments::insert([
                            'document_no' => $listofdocs[0][$index][0],
                            'document_title' => $listofdocs[0][$index][1],
                            'document_category' => $doc_cat, 
                            'revision_details' => $listofdocs[0][$index][2],
                            'batch_number' => $batch_number,
                            'start_date' => $request->start_date,
                            'expiry_date' => $request->end_date,
                            'date_uploaded' => date('Y-m-d'),
                            'created_by' => Auth::user()->id,
                            'last_updated_by' => Auth::user()->id,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'created_at' => date('Y-m-d H:i:s')   
     
                        ]);
                    }
                }
            }

            DB::commit();
                $pending = ListOfDocuments::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 2)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_listofdocs', $data, function($message) use($recipients){
                        $message->to($recipients)->subject('Status Board System Content Approval Notification');

                    });

                    return response()->json([
                        'result' => 1
                    ]);

                }else{

                    return response()->json([
                        'result' => 0
                    ]);            
                }                
            return response()->json(['result' => 1]);
        }

        catch(\Exception $e) {
            DB::rollback();
            return response()->json(['result' => $e]);
        }                
    }      

    public function change_listofdocs_stat_by_batch(Request $request){        
        date_default_timezone_set('Asia/Manila');

            ListOfDocuments::where('batch_number', $request->approveperbatch)
                ->update(
                [
                'status'=> 1,
                'last_updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')      
                ]);

                return response()->json(['result' => "1"]);        

    }                         
}
