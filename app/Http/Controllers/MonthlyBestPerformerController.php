<?php

namespace App\Http\Controllers;

use App\Model\MonthlyBestPerformer;
use App\Model\SetInterval;
use App\User;
use App\Imports\MonthlyBestPerformersImport;
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

class MonthlyBestPerformerController extends Controller
{
    public function view_monthlybestperformers(){
        $mthlybestperformers = MonthlyBestPerformer::where('status', '!=', 3)->orderBy('created_at', 'DESC')->get();

        return DataTables::of($mthlybestperformers)
            ->addColumn('label1', function($mthlybestperfs){
                $result = "";

                if($mthlybestperfs->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($mthlybestperfs){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';
                if($mthlybestperfs->status == 1){

                    $result .= '<button class="dropdown-item aEditMthlyBestPerfsContent" type="button" mthlybestperfs-id="' . $mthlybestperfs->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditMthlyBestPerfsContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeMthlyBestPerfsContentStat" type="button" mthlybestperfs-id="' . $mthlybestperfs->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeMthlyBestPerfsContentStat" data-keyboard="false">Disapprove</button>';

                    $result .= '<button class="dropdown-item aChangeMthlyBestPerfsContentStat" type="button" mthlybestperfs-id="' . $mthlybestperfs->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeMthlyBestPerfsContentStat" data-keyboard="false">Delete</button>';
                    }
                }
                else{
                    $result .= '<button class="dropdown-item aEditMthlyBestPerfsContent" type="button" mthlybestperfs-id="' . $mthlybestperfs->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditMthlyBestPerfsContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeMthlyBestPerfsContentStat" type="button" style="padding: 1px 1px; text-align: center;" mthlybestperfs-id="' . $mthlybestperfs->id . '" status="1" data-toggle="modal" data-target="#modalChangeMthlyBestPerfsContentStat" data-keyboard="false">Approve</button>';

                    $result .= '<button class="dropdown-item aChangeMthlyBestPerfsContentStat" type="button" mthlybestperfs-id="' . $mthlybestperfs->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeMthlyBestPerfsContentStat" data-keyboard="false">Delete</button>';
                    }
                }

                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('award_category_label', function($mthlybestperfs){
                $award_category = '';

                if($mthlybestperfs->category == 1){
                    $award_category = 'Best Operator';
                }
                else if($mthlybestperfs->category == 2){
                    $award_category = 'Best Machine Operator';
                }
                else if($mthlybestperfs->category == 3){
                    $award_category = 'Best Material Handler';
                }
                else if($mthlybestperfs->category == 4){
                    $award_category = 'Best Supervisor';
                }
                else if($mthlybestperfs->category == 5){
                    $award_category = 'Best Clerk';
                }
                else if($mthlybestperfs->category == 6){
                    $award_category = 'Best Warehouse MH';
                }
                else if($mthlybestperfs->category == 7){
                    $award_category = 'Best Inspector';
                }
                else if($mthlybestperfs->category == 8){
                    $award_category = 'Best QC Supervisor';
                }
                else if($mthlybestperfs->category == 9){
                    $award_category = 'Best Planner';
                }
                else if($mthlybestperfs->category == 10){
                    $award_category = 'Best Technician';
                }
                else if($mthlybestperfs->category == 11){
                    $award_category = 'Best Engineer';
                }
                else if($mthlybestperfs->category == 12){
                    $award_category = 'Best Kaizen(Staff)';
                }
                else if($mthlybestperfs->category == 13){
                    $award_category = 'Best Kaizen(Non-Staff)';
                }
                else if($mthlybestperfs->category == 14){
                    $award_category = 'Best in Productivity';
                }
                else if($mthlybestperfs->category == 15){
                    $award_category = 'Most # of Defect Escalate';
                }
                else if($mthlybestperfs->category == 16){
                    $award_category = 'Best 5S';
                }
                else if($mthlybestperfs->category == 17){
                    $award_category = 'Best Poka-Yoke';
                }
                else if($mthlybestperfs->category == 18){
                    $award_category = 'Best in Quality';
                }
                return $award_category;
            })
            ->addColumn('checkbox', function($mthlybestperfs){
                return '<center><input type="checkbox" class="chkMOD" mthlybestperfs-id="' . $mthlybestperfs->id . '"></center>';
            })
             ->addColumn('raw_image', function ($image) {
              $url=asset("storage/app/public/images/monthly_best_performers/$image->imagefilename");
              return '<a href="'.$url.'" data-lightbox="'.$url.'"><img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" /></a>';
            })
            ->rawColumns(['label1', 'action1', 'checkbox','raw_image','award_category_label'])
            ->make(true);
    }

    public function add_monthlybestperformers(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'empname' => ['required', 'string', 'max:255'],
            'award_category' => ['string', 'max:255'],
            'month' => ['required', 'string', 'max:255'],
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'start_date' => ['string', 'max:255'],
            'expiry_date' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

        if($request->hasFile('images')){
            $pdf_extension = "";
            if(isset($request->images)) {
               $extension = $request->file('images')->getClientOriginalExtension();
            }

            $image_name = "";
            if(isset($request->images)) {
                  $image_name = date('YmdHis') . \Str::random(5) . '.' . $extension;
            }

            if(isset($request->images)) {
               if(!\Storage::putFileAs('public/images/monthly_best_performers', $request->file('images'), $image_name)){

                }
            }
        }
            //nmodify clark 04/30/2025
            $categoryId = $request->award_category;
            $startDate = $request->start_date;
            $expiryDate = $request->end_date;

            $overlapExists = MonthlyBestPerformer::where('category', $categoryId)
                            ->where(function ($query) use ($startDate, $expiryDate) {
                                $query->where('start_date', '<=', $expiryDate)
                                    ->where('expiry_date', '>=', $startDate);
                            })
                            ->exists();

            if ($overlapExists) {
                return response()->json(['result' => "2"]);
            }else{ //nmodify clark 04/30/2025
                try{
                    MonthlyBestPerformer::insert([
                        'category' => $request->award_category,
                        'employee_name' => $request->empname,
                        'imagefilename' => $image_name,
                        'content_month' => $request->month,
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

    public function setinterval_monthlybestperformers(Request $request){
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

    public function get_monthlybestperformers_by_id(Request $request){
        $mthlybestperf = MonthlyBestPerformer::where('id', $request->mthlybestperfs_id)->get();
        return response()->json(['mthlybestperformers' => $mthlybestperf]);
    }
    public function edit_monthlybestperformers(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'mthlybestperf_id' => 'required|string|max:255'. $request->mthlybestperf_id,
            'empname' => 'string|max:255'. $request->mthlybestperf_id,
            'month' => 'string|max:255'. $request->mthlybestperf_id,
            'start_date' => 'string|max:255'. $request->mthlybestperf_id,
            'expiry_date' => 'string|max:255'. $request->mthlybestperf_id,
            'award_category' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            if($request->hasFile('images')){
                $pdf_extension = "";
                if(isset($request->images)) {
                   $extension = $request->file('images')->getClientOriginalExtension();
                }

                $image_name = "";
                if(isset($request->images)) {
                      $image_name = date('YmdHis') . \Str::random(5) . '.' . $extension;
                }

                if(isset($request->images)) {
                   if(!\Storage::putFileAs('public/images/monthly_best_performers', $request->file('images'), $image_name)){

                    }
                }

                //nmodify clark 04/30/2025
                $categoryId = $request->award_category;
                $startDate = $request->start_date;
                $expiryDate = $request->end_date;

                $overlapExists = MonthlyBestPerformer::where('category', $categoryId)
                            ->where(function ($query) use ($startDate, $expiryDate) {
                                $query->where('start_date', '<=', $expiryDate)
                                    ->where('expiry_date', '>=', $startDate);
                            })
                            ->exists();
                if ($overlapExists) {
                    return response()->json(['result' => "2"]);
                }else{ //nmodify clark 04/30/2025

                    try{
                        MonthlyBestPerformer::where('id', $request->mthlybestperf_id)
                        ->update(
                        [
                        'category' => $request->award_category,
                        'employee_name' => $request->empname,
                        'imagefilename' => $image_name,
                        'content_month' => $request->month,
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
            }else{

                //nmodify clark 04/30/2025
                $categoryId = $request->award_category;
                $startDate = $request->start_date;
                $expiryDate = $request->end_date;

                $overlapExists = MonthlyBestPerformer::where('category', $categoryId)
                            ->where(function ($query) use ($startDate, $expiryDate) {
                                $query->where('start_date', '<=', $expiryDate)
                                    ->where('expiry_date', '>=', $startDate);
                            })
                            ->exists();

                if ($overlapExists) {
                    return response()->json(['result' => "2"]);
                }else{ //nmodify clark 04/30/2025
                    try{
                        MonthlyBestPerformer::where('id', $request->mthlybestperf_id)
                        ->update(
                        [
                        'category' => $request->award_category,
                        'employee_name' => $request->empname,
                        'content_month' => $request->month,
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
    }
    public function change_monthlybestperformers_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'mthlybestperf_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                MonthlyBestPerformer::where('id', $request->mthlybestperf_id)
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

    public function get_monthlybestperformers_by_stat(Request $request){
        $mthlybestperfs = MonthlyBestPerformer::where('status', $request->status)->get();
        $perbatchnumber = MonthlyBestPerformer::select('batch_number')->where('status', 2)->distinct('batch_number')->get();
        return response()->json([
            'mthlybestperfs' => $mthlybestperfs,
            'perbatchnumber' => $perbatchnumber
        ]);
    }

    public function import_monthlybestperformers(Request $request)
    {
        DB::beginTransaction();
        try{

            if(request()->file('import_file_mthlybestperfs')){
                $mthlybestperfs = Excel::toCollection(new MonthlyBestPerformersImport, request()->file('import_file_mthlybestperfs'));


                if ($mthlybestperfs != null) {

                    $data = MonthlyBestPerformer::where('batch_number', '!=', null)->orderBy('batch_number', 'desc')->first();
                    $batch_number = 1;

                    if ($data != null) {
                        $batch_number = $data->batch_number + 1;
                    }
                    for($index = 2; $index < count($mthlybestperfs[0]); $index++){

                        $award_cat = '';

                        if ($mthlybestperfs[0][$index][1] == 'Best Operator') {
                            $award_cat = 1;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Machine Operator') {
                            $award_cat = 2;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Material Handler') {
                            $award_cat = 3;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Supervisor') {
                            $award_cat = 4;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Clerk') {
                            $award_cat = 5;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Warehouse MH') {
                            $award_cat = 6;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Inspector') {
                            $award_cat = 7;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best QC Supervisor') {
                            $award_cat = 8;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Planner') {
                            $award_cat = 9;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Technician') {
                            $award_cat = 10;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Engineer') {
                            $award_cat = 11;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Kaizen (Staff)') {
                            $award_cat = 12;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best Kaizen (Non-Staff)') {
                            $award_cat = 13;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best in Productivity') {
                            $award_cat = 14;
                        }else if ($mthlybestperfs[0][$index][1] == 'Most# of Defect Escalate') {
                            $award_cat = 15;
                        }else if ($mthlybestperfs[0][$index][1] == 'Best 5S') {
                            $award_cat = 16;
                        }else{
                            $award_cat = 17;
                        }

                        MonthlyBestPerformer::insert([
                            'category' => $award_cat,
                            'employee_name' => $mthlybestperfs[0][$index][0],
                            'content_month' => $mthlybestperfs[0][$index][2],
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

                $pending = MonthlyBestPerformer::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];

                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 3)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_mthlybestperfs', $data, function($message) use($recipients){
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

    public function change_monthlybestperformers_stat_by_batch(Request $request){
        date_default_timezone_set('Asia/Manila');

        $nullimage = MonthlyBestPerformer::where('batch_number', $request->approveperbatch)->where('imagefilename', '=', null)->get();

        if (count($nullimage) <= 0) {
            try{
                MonthlyBestPerformer::where('batch_number', $request->approveperbatch)
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
