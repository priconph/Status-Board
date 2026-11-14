<?php

namespace App\Http\Controllers;

use App\Model\LotOutDefect;
use App\Model\SetInterval;
use App\User;
use App\Imports\LotOutDefectsImport;
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

class LotOutDefectsController extends Controller
{
    public function view_lotoutdefects(){
        $lotoutdef = LotOutDefect::where('status', '!=', 3);

        return DataTables::of($lotoutdef)
            ->addColumn('label1', function($lotoutdefect){
                $result = "";

                if($lotoutdefect->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($lotoutdefect){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i> 
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';
                if($lotoutdefect->status == 1){

                    $result .= '<button class="dropdown-item aEditLotOutDefContent" type="button" lotoutdefect-id="' . $lotoutdefect->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditLotOutDefContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeLotOutDefContentStat" type="button" lotoutdefect-id="' . $lotoutdefect->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeLotOutDefContentStat" data-keyboard="false">Disapprove</button>';

                    $result .= '<button class="dropdown-item aChangeLotOutDefContentStat" type="button" lotoutdefect-id="' . $lotoutdefect->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeLotOutDefContentStat" data-keyboard="false">Delete</button>';
                    }                         
                }
                else{
                    $result .= '<button class="dropdown-item aEditLotOutDefContent" type="button" lotoutdefect-id="' . $lotoutdefect->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditLotOutDefContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {                           

                        $result .= '<button class="dropdown-item aChangeLotOutDefContentStat" type="button" style="padding: 1px 1px; text-align: center;" lotoutdefect-id="' . $lotoutdefect->id . '" status="1" data-toggle="modal" data-target="#modalChangeLotOutDefContentStat" data-keyboard="false">Approve</button>';
                        
                        $result .= '<button class="dropdown-item aChangeLotOutDefContentStat" type="button" lotoutdefect-id="' . $lotoutdefect->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeLotOutDefContentStat" data-keyboard="false">Delete</button>';                        
                    }
                }
                            
                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('checkbox', function($lotoutdefect){
                return '<center><input type="checkbox" class="chkMOD" lotoutdefect-id="' . $lotoutdefect->id . '"></center>';
            })
             ->addColumn('raw_image', function ($image) { 
              $url=asset("storage/app/public/images/lotout_defects/$image->imagefilename"); 
              return '<a href="'.$url.'" data-lightbox="'.$url.'"><img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" /></a>'; 
            }) 
            ->rawColumns(['label1', 'action1', 'checkbox','raw_image'])
            ->make(true);
    }

    public function add_lotoutdefects(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();



        $validator = Validator::make($data, [
            'devicename' => ['required', 'string', 'max:255'],
            'modeofdefect' => ['string', 'max:255'],
            'contributingline' => ['string', 'max:255'],
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
               if(!\Storage::putFileAs('public/images/lotout_defects', $request->file('images'), $image_name)){

                }
            }
        }
            try{
                LotOutDefect::insert([
                    'device_name' => $request->devicename,
                    'mode_of_defect' => $request->modeofdefect,
                    'contributing_line' => $request->contributingline,
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

                $pending = LotOutDefect::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 2)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_lotoutdef', $data, function($message) use($recipients){
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

    public function setinterval_lotoutdefects(Request $request){
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

    public function get_lotoutdefects_by_id(Request $request){
        $lotoutdef = LotOutDefect::where('id', $request->lotoutdefcont_id)->get();
        return response()->json(['lotoutdefects' => $lotoutdef]);
    }  

    public function edit_lotoutdefects(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'lotoutdef_id' => 'required|string|max:255'. $request->lotoutdefcont_id,
            'devicename' => 'required|string|max:255'. $request->lotoutdefcont_id,
            'modeofdefect' => 'string|max:255'. $request->lotoutdefcont_id,
            'contributingline' => 'string|max:255'. $request->lotoutdefcont_id,
            'datedetected' => 'string|max:255'. $request->lotoutdefcont_id,
            'start_date' => 'string|max:255'. $request->lotoutdefcont_id,
            'expiry_date' => 'string|max:255'. $request->lotoutdefcont_id,            
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
                   if(!\Storage::putFileAs('public/images/lotout_defects', $request->file('images'), $image_name)){

                    }
                }

                try{
                    LotOutDefect::where('id', $request->lotoutdef_id)
                    ->update(
                    [
                    'device_name'=> $request->devicename,
                    'mode_of_defect'=> $request->modeofdefect,
                    'contributing_line'=> $request->contributingline,
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
                    LotOutDefect::where('id', $request->lotoutdef_id)
                    ->update(
                    [
                    'device_name'=> $request->devicename,
                    'mode_of_defect'=> $request->modeofdefect,
                    'contributing_line'=> $request->contributingline,
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

    public function change_lotoutdefects_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'lotoutdef_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                LotOutDefect::where('id', $request->lotoutdef_id)
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

    public function get_lotoutdefects_by_stat(Request $request){
        $lotoutdefects = LotOutDefect::where('status', $request->status)->get();
        $perbatchnumber = LotOutDefect::select('batch_number')->where('status', 2)->distinct('batch_number')->get();
        return response()->json([
            'lotoutdefects' => $lotoutdefects,
            'perbatchnumber' => $perbatchnumber
        ]);
    }

    public function import_lotoutdefects(Request $request)
    {
        DB::beginTransaction();
        try{

            if(request()->file('import_file_lotoutdefs')){
                $lotoutdefs = Excel::toCollection(new LotOutDefectsImport, request()->file('import_file_lotoutdefs'));

                
                if ($lotoutdefs != null) {

                    $data = LotOutDefect::where('batch_number', '!=', null)->orderBy('batch_number', 'desc')->first();
                    $batch_number = 1;

                    if ($data != null) {
                        $batch_number = $data->batch_number + 1;
                    }
                    for($index = 2; $index < count($lotoutdefs[0]); $index++){
                        LotOutDefect::insert([
                            'device_name' => $lotoutdefs[0][$index][0],
                            'mode_of_defect' => $lotoutdefs[0][$index][1],
                            'contributing_line' => $lotoutdefs[0][$index][2],
                            'date_detected' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($lotoutdefs[0][$index][3])->format('Y-m-d'),   
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

                $pending = LotOutDefect::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 2)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_lotoutdef', $data, function($message) use($recipients){
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

    public function change_lotoutdefects_stat_by_batch(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $nullimage = LotOutDefect::where('batch_number', $request->approveperbatch)->where('imagefilename', '=', null)->get();

        if (count($nullimage) <= 0) {
            try{
                LotOutDefect::where('batch_number', $request->approveperbatch)
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
