<?php

namespace App\Http\Controllers;

use App\Model\ProdLineEffMonitoring;
use App\Model\SetInterval;
use App\User;
use App\Imports\ProdLineEffMonitoringImport;
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

class ProdLineEffMonitoringController extends Controller
{
    public function view_prodlineeffmonitoring(){
        $prodlinemon = ProdLineEffMonitoring::where('status', '!=', 3)->orderBy('created_at', 'DESC')->get();

        return DataTables::of($prodlinemon)
            ->addColumn('label1', function($prodlineeffmon){
                $result = "";

                if($prodlineeffmon->status == 1){
                    $result .= '<span class="badge badge-pill badge-success">Approved</span>';
                }
                else{
                    $result .= '<span class="badge badge-pill badge-danger">Pending</span>';
                }

                return $result;
            })
            ->addColumn('action1', function($prodlineeffmon){
                $result = '<center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Action">
                            <i class="fa fa-cog"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">';

                if($prodlineeffmon->status == 1){

                    $result .= '<button class="dropdown-item aEditProdLineMonContent" type="button" prodlineeffmon-id="' . $prodlineeffmon->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditProdLineEffMonContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                    $result .= '<button class="dropdown-item aChangeProdLineMonContentStat" type="button" prodlineeffmon-id="' . $prodlineeffmon->id . '" status="2" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeProdLineEffMonContentStat" data-keyboard="false">Disapprove</button>';

                    $result .= '<button class="dropdown-item aChangeProdLineMonContentStat" type="button" prodlineeffmon-id="' . $prodlineeffmon->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeProdLineEffMonContentStat" data-keyboard="false">Delete</button>';
                    }
                }
                else{
                    $result .= '<button class="dropdown-item aEditProdLineMonContent" type="button" prodlineeffmon-id="' . $prodlineeffmon->id . '" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#EditProdLineEffMonContentModal" data-keyboard="false">Edit</button>';

                    if (Auth::user()->user_level_id == 2) {

                        $result .= '<button class="dropdown-item aChangeProdLineMonContentStat" type="button" style="padding: 1px 1px; text-align: center;" prodlineeffmon-id="' . $prodlineeffmon->id . '" status="1" data-toggle="modal" data-target="#modalChangeProdLineEffMonContentStat" data-keyboard="false">Approve</button>';

                        $result .= '<button class="dropdown-item aChangeProdLineMonContentStat" type="button" prodlineeffmon-id="' . $prodlineeffmon->id . '" status="3" style="padding: 1px 1px; text-align: center;" data-toggle="modal" data-target="#modalChangeProdLineEffMonContentStat" data-keyboard="false">Delete</button>';
                    }
                }

                $result .= '</div>
                        </div></center>';

                return $result;
            })
            ->addColumn('prod_line_label', function($prodlineeffmon){
                $prod_line = '';

                if($prodlineeffmon->line == 1){
                    $prod_line = 'BGAFP';
                }
                else if($prodlineeffmon->line == 2){
                    $prod_line = 'BGA / LGA';
                }
                else if($prodlineeffmon->line == 3){
                    $prod_line = 'QFP / TSOP';
                }
                else if($prodlineeffmon->line == 4){
                    $prod_line = 'SMPO';
                }
                else if($prodlineeffmon->line == 5){
                    $prod_line = 'PROBE';
                }
                return $prod_line;
            })
            ->addColumn('actual_eff', function($prodlineeffmon){
                return $prodlineeffmon->actual_efficiency . "%";
            })
            ->addColumn('target_percent', function($prodlineeffmon){
                return $prodlineeffmon->target . "%";
            })
            ->addColumn('checkbox', function($prodlineeffmon){
                return '<center><input type="checkbox" class="chkMOD" prodlineeffmon-id="' . $prodlineeffmon->id . '"></center>';
            })
            ->rawColumns(['label1', 'action1', 'checkbox', 'prod_line_label', 'actual_eff', 'target_percent'])
            ->make(true);
    }

    public function add_prodlineeffmonitoring(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'productionline' => ['required', 'string', 'max:255'],
            'target' => ['required', 'string', 'max:255'],
            'month' => ['required', 'string', 'max:255'],
            'actualefficiency' => ['string', 'max:255'],
            'result' => ['string', 'max:255'],
            'start_date' => ['string', 'max:255'],
            'expiry_date' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                ProdLineEffMonitoring::insert([
                    'line' => $request->productionline,
                    'actual_efficiency' => $request->actualefficiency,
                    'result' => $request->result,
                    'target' => $request->target,
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



                $pending = ProdLineEffMonitoring::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];

                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 3)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_prodlineffmon', $data, function($message) use($recipients){
                        $message->to($recipients)->subject('Status Board System Content Approval Notification');

                    });

                    DB::commit();
                    return response()->json([
                        'result' => 1
                    ]);

                }else{

                    DB::commit();
                    return response()->json([
                        'result' => 2
                    ]);
                }

                // return response()->json(['result' => "1"]);
            }
            catch(Exception $e) {
                DB::rollback();
                // throw $e;
                return response()->json(['result' => "0", 'results' => $e]);
            }
        }
    }

    public function setinterval_prodlineeffmonitoring(Request $request){
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

    public function get_prodlineeffmonitoring_by_id(Request $request){
        $prodlineeffmon = ProdLineEffMonitoring::where('id', $request->prodlineeffmon_id)->get();
        return response()->json(['prodlineeffmonitoring' => $prodlineeffmon]);
    }

    public function edit_prodlineeffmonitoring(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'prodlineeffmon_id' => 'required|string|max:255'. $request->prodlineeffmon_id,
            'actualefficiency' => 'string|max:255'. $request->prodlineeffmon_id,
            'result' => 'string|max:255'. $request->prodlineeffmon_id,
            'target' => 'string|max:255'. $request->prodlineeffmon_id,
            'month' => 'string|max:255'. $request->prodlineeffmon_id,
            'start_date' => 'string|max:255'. $request->prodlineeffmon_id,
            'expiry_date' => 'string|max:255'. $request->prodlineeffmon_id,
            'productionline' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => '0', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();

            try{
                ProdLineEffMonitoring::where('id', $request->prodlineeffmon_id)
                ->update(
                [
                'line' => $request->productionline,
                'actual_efficiency' => $request->actualefficiency,
                'result' => $request->result,
                'target' => $request->target,
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

    public function change_prodlineeffmonitoring_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all();

        $validator = Validator::make($data, [
            'prodlineeffmon_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            try{
                ProdLineEffMonitoring::where('id', $request->prodlineeffmon_id)
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

    public function get_prodlineeffmonitoring_by_stat(Request $request){
        $prodlineeffmon = ProdLineEffMonitoring::where('status', $request->status)->get();
        $perbatchnumber = ProdLineEffMonitoring::select('batch_number')->where('status', 2)->distinct('batch_number')->get();
        return response()->json([
            'prodlineeffmon' => $prodlineeffmon,
            'perbatchnumber' => $perbatchnumber
        ]);
    }

    public function import_prodlineeffmonitoring(Request $request)
    {
        DB::beginTransaction();
        try{

            if(request()->file('import_file_prodlineeffmon')){
                $prodlineeffmon = Excel::toCollection(new ProdLineEffMonitoringImport, request()->file('import_file_prodlineeffmon'));


                if ($prodlineeffmon != null) {

                    $data = ProdLineEffMonitoring::where('batch_number', '!=', null)->orderBy('batch_number', 'desc')->first();
                    $batch_number = 1;

                    if ($data != null) {
                        $batch_number = $data->batch_number + 1;
                    }
                    for($index = 2; $index < count($prodlineeffmon[0]); $index++){

                        $line_cat = '';

                        if ($prodlineeffmon[0][$index][0] == 'BGA-FP') {
                            $line_cat = 1;
                        }else if ($prodlineeffmon[0][$index][0] == 'BGA/LGA') {
                            $line_cat = 2;
                        }else if ($prodlineeffmon[0][$index][0] == 'QFP/TSOP') {
                            $line_cat = 3;
                        }else if ($prodlineeffmon[0][$index][0] == 'SMPO') {
                            $line_cat = 4;
                        }else{
                            $line_cat = 5;
                        }
                        ProdLineEffMonitoring::insert([
                            'line' => $line_cat,
                            'actual_efficiency' => $prodlineeffmon[0][$index][1],
                            'result' => $prodlineeffmon[0][$index][2],
                            'target' => $prodlineeffmon[0][$index][3],
                            'content_month' => $prodlineeffmon[0][$index][4],
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
                $pending = ProdLineEffMonitoring::where('status', 2)->get();
                $pendingcount = count($pending);
                $data = [];

                if ($pendingcount != 0) {
                    $recipients = User::where('status', 1)->where('user_level_id', 2)->where('user_classification_id', 3)->pluck('email')->toArray();

                    Mail::send('mail.status_board_mailer_prodlineffmon', $data, function($message) use($recipients){
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
    public function change_prodlineeffmonitoring_stat_by_batch(Request $request){
        date_default_timezone_set('Asia/Manila');

            ProdLineEffMonitoring::where('batch_number', $request->approveperbatch)
                ->update(
                [
                'status'=> 1,
                'last_updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')
                ]);

                return response()->json(['result' => "1"]);

    }
}
