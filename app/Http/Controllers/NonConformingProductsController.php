<?php

namespace App\Http\Controllers;

use App\Model\NonConformingProducts;
use App\Model\SetInterval;
use App\User;
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
use Mail;

class NonConformingProductsController extends Controller
{
    public function view_nonconformingproducts(){
        $nonconfprod = NonConformingProducts::where('status', '!=', 3);

        return DataTables::of($nonconfprod)
            ->addColumn('label1', function($nonconformingproducts){
                $result = "";

                if($nonconformingproducts->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($nonconformingproducts){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i> 
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';
                if($nonconformingproducts->status == 1){

                    $result .= '<button class="dropdown-item aEditNonConfProdContent" type="button" nonconformingproducts-id="' . $nonconformingproducts->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditNonConfProdContentModal" data-keyboard="false">Edit</button>';
                    
                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeNonConfProdContentStat" type="button" nonconformingproducts-id="' . $nonconformingproducts->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeNonConfProdContentStat" data-keyboard="false">Disapprove</button>';

                    $result .= '<button class="dropdown-item aChangeNonConfProdContentStat" type="button" nonconformingproducts-id="' . $nonconformingproducts->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeNonConfProdContentStat" data-keyboard="false">Delete</button>';
                    }                    
                }
                else{

                    $result .= '<button class="dropdown-item aEditNonConfProdContent" type="button" nonconformingproducts-id="' . $nonconformingproducts->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditNonConfProdContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                        $result .= '<button class="dropdown-item aChangeNonConfProdContentStat" type="button" style="padding: 1px 1px; text-align: center;" nonconformingproducts-id="' . $nonconformingproducts->id . '" status="1" data-toggle="modal" data-target="#modalChangeNonConfProdContentStat" data-keyboard="false">Approve</button>';

                        $result .= '<button class="dropdown-item aChangeNonConfProdContentStat" type="button" nonconformingproducts-id="' . $nonconformingproducts->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeNonConfProdContentStat" data-keyboard="false">Delete</button>';                           
                    }      

                }
                            
                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('raw_image', function ($image) { 
              $url=asset("storage/app/public/images/ojt/$image->imagefilename"); 
              return '<a href="'.$url.'" data-lightbox="'.$url.'"><img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" /></a>'; 
            })
            ->addColumn('checkbox', function($nonconformingproducts){
                return '<center><input type="checkbox" class="chkMOD" nonconformingproducts-id="' . $nonconformingproducts->id . '"></center>';
            })
            ->rawColumns(['label1', 'action1', 'checkbox','raw_image'])
            ->make(true);
    }

    public function add_nonconformingproducts(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'productname' => ['required', 'string', 'max:255'],
            'po_number' => ['string', 'max:255'],
            'problem' => ['string', 'max:255'],
            'ptis_ng_reportnumber' => ['required', 'string', 'max:255'],
            'status_disposition' => ['string', 'max:255'],
            'cont_date' => ['string', 'max:255'],
            'start_date' => ['string', 'max:255'], 
            'expiry_date' => ['string', 'max:255'],         
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                NonConformingProducts::insert([
                    'product_name' => $request->productname,
                    'po_number' => $request->po_number,
                    'problem' => $request->problem,
                    'ptis_ng_report_number' => $request->ptis_ng_reportnumber,
                    'status_disposition' => $request->status_disposition,
                    'content_date' => $request->cont_date,
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
                
                $pending = NonConformingProducts::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 1)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_nonconfprod', $data, function($message) use($recipients){
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

    public function setinterval_nonconformingproducts(Request $request){
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
    public function get_nonconformingproducts_by_id(Request $request){
        $nonconfprodcont = NonConformingProducts::where('id', $request->nonconfprodcont_id)->get();
        return response()->json(['nonconformingproducts' => $nonconfprodcont]);
    }  

     public function edit_nonconformingproducts(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'productname' => 'required|string|max:255'. $request->nonconfprod_id,
            'po_number' => 'string|max:255'. $request->nonconfprod_id,
            'problem' => 'string|max:255'. $request->nonconfprod_id,
            'ptis_ng_reportnumber' => 'string|max:255'. $request->nonconfprod_id,
            'status_disposition' => 'string|max:255'. $request->nonconfprod_id,
            'cont_date' => 'string|max:255'. $request->nonconfprod_id,
            'start_date' => 'string|max:255'. $request->nonconfprod_id,
            'expiry_date' => 'string|max:255'. $request->nonconfprod_id,
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                NonConformingProducts::where('id', $request->nonconfprod_id)
                ->update(
                [
                'product_name'=> $request->productname,
                'po_number'=> $request->po_number,
                'problem'=> $request->problem,
                'ptis_ng_report_number'=> $request->ptis_ng_reportnumber,
                'status_disposition'=> $request->status_disposition,
                'content_date'=> $request->cont_date,
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

    public function change_nonconformingproducts_stat(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'nonconfprod_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                NonConformingProducts::where('id', $request->nonconfprod_id)
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

    public function get_nonconformingproducts_by_stat(Request $request){
        $nonconformingproducts = NonConformingProducts::where('status', $request->status)->get();
        $perbatchnumber = NonConformingProducts::select('batch_number')->where('status', 2)->distinct('batch_number')->get();
        return response()->json([
            'nonconformingproducts' => $nonconformingproducts,
            'perbatchnumber' => $perbatchnumber
        ]);
    } 

    public function import_nonconformingproducts(Request $request)
    {
        DB::beginTransaction();
        try{

            if(request()->file('import_file_nonconfprod')){
                $nonconfprods = Excel::toCollection(new NonConformingProductsImport, request()->file('import_file_nonconfprod'));

                
                if ($nonconfprods != null) {

                    $data = NonConformingProducts::where('batch_number', '!=', null)->orderBy('batch_number', 'desc')->first();
                    $batch_number = 1;

                    if ($data != null) {
                        $batch_number = $data->batch_number + 1;
                    }
                    for($index = 2; $index < count($nonconfprods[0]); $index++){
                        NonConformingProducts::insert([
                            'content_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($nonconfprods[0][$index][0])->format('Y-m-d'),
                            'product_name' => $nonconfprods[0][$index][1],
                            'po_number' => $nonconfprods[0][$index][2],
                            'problem' => $nonconfprods[0][$index][3],
                            'ptis_ng_report_number' => $nonconfprods[0][$index][4],    
                            'status_disposition' => $nonconfprods[0][$index][5],
                            'batch_number' => $batch_number,
                            'start_date' => $request->start_date,
                            'expiry_date' => $request->end_date,
                            'created_by' => Auth::user()->id,
                            'date_uploaded' => date('Y-m-d'),
                            'last_updated_by' => Auth::user()->id,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'created_at' => date('Y-m-d H:i:s')   
     
                        ]);
                    }
                }
            }

            DB::commit();

                $pending = NonConformingProducts::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];
                
                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 1)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_nonconfprod', $data, function($message) use($recipients){
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

    public function change_nonconformingproducts_stat_by_batch(Request $request){        
        date_default_timezone_set('Asia/Manila');

            NonConformingProducts::where('batch_number', $request->approveperbatch)
                ->update(
                [
                'status'=> 1,
                'last_updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')      
                ]);

                return response()->json(['result' => "1"]);        

    }                         
}
