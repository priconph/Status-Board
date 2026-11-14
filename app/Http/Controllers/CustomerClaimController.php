<?php

namespace App\Http\Controllers;

use App\Model\CustomerClaim;
use App\User;
use App\Imports\CustomerClaimImport;
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

class CustomerClaimController extends Controller
{
    public function view_customerclaim(){
        $custclaim = CustomerClaim::where('status', '!=', 3);

        return DataTables::of($custclaim)
            ->addColumn('label1', function($customerclaim){
                $result = "";

                if($customerclaim->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($customerclaim){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i> 
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';
                if($customerclaim->status == 1){
                    $result .= '<button class="dropdown-item aEditCustClaimContent" type="button" custclaim-id="' . $customerclaim->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditCustClaimContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeCustClaimContentStat" type="button" custclaim-id="' . $customerclaim->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeCustClaimContentStat" data-keyboard="false">Disapprove</button>';

                    $result .= '<button class="dropdown-item aChangeCustClaimContentStat" type="button" custclaim-id="' . $customerclaim->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeCustClaimContentStat" data-keyboard="false">Delete</button>';
                    }                          
                }
                else{
                    $result .= '<button class="dropdown-item aEditCustClaimContent" type="button" custclaim-id="' . $customerclaim->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditCustClaimContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {                    

                    $result .= '<button class="dropdown-item aChangeCustClaimContentStat" type="button" style="padding: 1px 1px; text-align: center;" custclaim-id="' . $customerclaim->id . '" status="1" data-toggle="modal" data-target="#modalChangeCustClaimContentStat" data-keyboard="false">Approve</button>';

                    $result .= '<button class="dropdown-item aChangeCustClaimContentStat" type="button" custclaim-id="' . $customerclaim->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeCustClaimContentStat" data-keyboard="false">Delete</button>';                    
                    }
                }
                            
                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('checkbox', function($customerclaim){
                return '<center><input type="checkbox" class="chkMOD" custclaim-id="' . $customerclaim->id  . '"></center>';
            })
             ->addColumn('raw_image', function ($image) { 
              $url=asset("storage/app/public/images/customer_claim/$image->imagefilename"); 
              return '<a href="'.$url.'" data-lightbox="'.$url.'"><img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" /></a>'; 
            }) 
            ->rawColumns(['label1', 'action1', 'checkbox','raw_image'])
            ->make(true);
    }

    public function add_customerclaim(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();



        $validator = Validator::make($data, [
            'devicename' => ['required', 'string', 'max:255'],
            'modeofdefect' => ['string', 'max:255'],
            'customer' => ['string', 'max:255'],
            'datedetected' => ['string', 'max:255'], 
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg',    
            'start_date' => ['string', 'max:255'], 
            'expiry_date' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

        if($request->hasFile('images'))
        {
            $pdf_extension = "";
            if(isset($request->images)) {
               $extension = $request->file('images')->getClientOriginalExtension();
            }

            $image_name = "";
            if(isset($request->images)) {
                  $image_name = date('YmdHis') . \Str::random(5) . '.' . $extension;
            }

            if(isset($request->images)) {
               if(!\Storage::putFileAs('public/images/customer_claim', $request->file('images'), $image_name)){

                }
            }
        }
            try{
                CustomerClaim::insert([
                    'device_name' => $request->devicename,
                    'mode_of_defect' => $request->modeofdefect,
                    'customer' => $request->customer,
                    'date_detected' => $request->datedetected,
                    'start_date' => $request->start_date,
                    'expiry_date' => $request->end_date, 
                    'imagefilename' => $image_name,                    
                    'status' => 2,
                    'date_uploaded' => date('Y-m-d'),
                    'created_by' => Auth::user()->id,
                    'last_updated_by' => Auth::user()->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')                   
                ]);

                DB::commit();

                $pending = CustomerClaim::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 2)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_custclaim', $data, function($message) use($recipients){
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

    public function get_customerclaim_by_id(Request $request){
        $custclaim = CustomerClaim::where('id', $request->custclaimcont_id)->get();
        return response()->json(['customerclaim' => $custclaim]);
    }  

    public function edit_customerclaim(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'custcla_id' => 'required|string|max:255'. $request->custclaimcont_id,
            'devicename' => 'required|string|max:255'. $request->custclaimcont_id,
            'modeofdefect' => 'string|max:255'. $request->custclaimcont_id,
            'customer' => 'string|max:255'. $request->custclaimcont_id,
            'datedetected' => 'string|max:255'. $request->custclaimcont_id,
            'start_date' => 'string|max:255'. $request->custclaimcont_id,
            'expiry_date' => 'string|max:255'. $request->custclaimcont_id,            
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            if($request->hasFile('images'))
            {
                $pdf_extension = "";
                if(isset($request->images)) {
                   $extension = $request->file('images')->getClientOriginalExtension();
                }

                $image_name = "";
                if(isset($request->images)) {
                      $image_name = date('YmdHis') . \Str::random(5) . '.' . $extension;
                }

                if(isset($request->images)) {
                   if(!\Storage::putFileAs('public/images/customer_claim', $request->file('images'), $image_name)){

                    }
                }

                try{
                    CustomerClaim::where('id', $request->custcla_id)
                    ->update(
                    [
                    'device_name'=> $request->devicename,
                    'mode_of_defect'=> $request->modeofdefect,
                    'customer'=> $request->customer,
                    'date_detected'=> $request->datedetected,
                    'start_date'=> $request->start_date,
                    'expiry_date'=> $request->end_date,                    
                    'imagefilename' => $image_name,
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
            else{
                 try{
                    CustomerClaim::where('id', $request->custcla_id)
                    ->update(
                    [
                    'device_name'=> $request->devicename,
                    'mode_of_defect'=> $request->modeofdefect,
                    'customer'=> $request->customer,
                    'date_detected'=> $request->datedetected,
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
    }


    public function change_customerclaim_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'custcla_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                CustomerClaim::where('id', $request->custcla_id)
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

    public function get_customerclaim_by_stat(Request $request){
        $customerclaim = CustomerClaim::where('status', $request->status)->get();
        $perbatchnumber = CustomerClaim::select('batch_number')->where('status', 2)->distinct('batch_number')->get();
        return response()->json([
            'customerclaim' => $customerclaim,
            'perbatchnumber' => $perbatchnumber
        ]);
    } 

    public function import_customerclaim(Request $request)
    {
        DB::beginTransaction();
        try{

            if(request()->file('import_file_custclaim')){
                $custclaim = Excel::toCollection(new CustomerClaimImport, request()->file('import_file_custclaim'));

                
                if ($custclaim != null) {

                    $data = CustomerClaim::where('batch_number', '!=', null)->orderBy('batch_number', 'desc')->first();
                    $batch_number = 1;

                    if ($data != null) {
                        $batch_number = $data->batch_number + 1;
                    }
                    for($index = 2; $index < count($custclaim[0]); $index++){
                        CustomerClaim::insert([
                            'device_name' => $custclaim[0][$index][0],
                            'mode_of_defect' => $custclaim[0][$index][1],
                            'customer' => $custclaim[0][$index][2],
                            'date_detected' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($custclaim[0][$index][3])->format('Y-m-d'),   
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
                $pending = CustomerClaim::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 2)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_custclaim', $data, function($message) use($recipients){
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

    public function change_customerclaim_stat_by_batch(Request $request){        
        date_default_timezone_set('Asia/Manila');
        
        $nullimage = CustomerClaim::where('batch_number', $request->approveperbatch)->where('imagefilename', '=', null)->get();

        if (count($nullimage) <= 0) {
            try{
                CustomerClaim::where('batch_number', $request->approveperbatch)
                    ->update(
                    [
                    'status'=> 1,
                    'last_updated_by' => Auth::user()->id,
                    'updated_at' => date('Y-m-d H:i:s')      
                    ]);

                    return response()->json(['result' => "1"]);        
            }
            catch(\Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "2"]);
            }
        }else{
            DB::rollback();

            return response()->json(['result' => "0"]);
        }
    } 
}
