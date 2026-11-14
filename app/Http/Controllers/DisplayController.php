<?php

namespace App\Http\Controllers;

use App\Model\NonConformingProducts;
use App\Model\SetInterval;
use App\Model\LotOutDefect;
use App\Model\CustomerClaim;
use App\Model\ListOfDocuments;
use App\Model\MonthlyBestPerformer;
use App\Model\ProdLineEffMonitoring;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DataTables;
use Auth;

class DisplayController extends Controller
{
	public function display_enggcontent(){

        $dispcontentnonconfprod = NonConformingProducts::where('status', '1')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $nonconfprodinterval = SetInterval::where('carousel', 'Non-Conforming Products')->get();
        return response()->json([
            'dispcontentnonconfprod' => $dispcontentnonconfprod,
            'nonconfprodinterval' => $nonconfprodinterval
        ]);
    }

	public function display_qccontent_lotoutdefects(){

        $dispcontentlotoutdefs = LotOutDefect::where('status', '1')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentcustclaim = CustomerClaim::where('status', '1')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $lotoutdefsinterval = SetInterval::where('carousel', 'Lot Out Defects')->get();
        return response()->json([
            'dispcontentlotoutdefs' => $dispcontentlotoutdefs,
            'dispcontentcustclaim' => $dispcontentcustclaim,
            'lotoutdefsinterval' => $lotoutdefsinterval
        ]);
    }

	public function display_qccontent_customerclaim(){

        $dispcontentcustclaim = CustomerClaim::where('status', '1')->get();
        return response()->json(['dispcontentcustclaim' => $dispcontentcustclaim]);
    }

	public function display_qccontent_listofdocuments(){

        $dispcontentlistofdocswi = ListOfDocuments::where('status', '1')->where('document_category', '1')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentlistofdocspp = ListOfDocuments::where('status', '1')->where('document_category', '2')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentlistofdocspqs = ListOfDocuments::where('status', '1')->where('document_category', '3')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $listofdocsinterval = SetInterval::where('carousel', 'List of Documents')->get();
        return response()->json([
            'dispcontentlistofdocswi' => $dispcontentlistofdocswi,
            'dispcontentlistofdocspp' => $dispcontentlistofdocspp,
            'dispcontentlistofdocspqs' => $dispcontentlistofdocspqs,
            'listofdocsinterval' => $listofdocsinterval

        ]);
    }

    public function display_prodcontent_monthlybestperformers(Request $request){

        $dispcontentmthlybestperfs3 = MonthlyBestPerformer::where('status', '1')->where('category', '<=', 3)->orderBy('category')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentmthlybestperfs10 = MonthlyBestPerformer::where('status', '1')->where('category', '>=', 10)->where('category', '<=', 12)->orderBy('category' , 'asc')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentmthlybestperfs6 = MonthlyBestPerformer::where('status', '1')->where('category', '>=', 4)->where('category', '<=', 6)->orderBy('category')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentmthlybestperfs12 = MonthlyBestPerformer::where('status', '1')->where('category', '>=', 13)->where('category', '<=', 15)->orderBy('category' , 'asc')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        //OLD CODE
        // $dispcontentmthlybestperfs9 = MonthlyBestPerformer::where('status', '1')
        // ->where('category', '>=', 7)
        // ->where('category', '<=', 9)
        // ->orderBy('category')
        // ->where('start_date', '<=', Carbon::now())
        // ->where('expiry_date', '>=', Carbon::now())
        // ->get();

        //TEMP CODE
        $dispcontentmthlybestperfs9 = MonthlyBestPerformer::where('status', '1') // try only
        ->where(function ($query) {
            $query->whereBetween('category', [7, 9]);
                // ->orWhere('category', 23);
        })
        ->where('start_date', '<=', Carbon::now())
        ->where('expiry_date', '>=', Carbon::now())
        ->orderBy('category')
        ->get();
        //modify category, added 21, and 22. ->where('category', '>=', 16)->where('category', '<=', 19) code before
        $dispcontentmthlybestperfs16 = MonthlyBestPerformer::where('status', '1')->where('category', '>=', 16)->where('category', '<=', 18)->orderBy('category' , 'asc')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        //nmodify clark 04/30/2025
        $dispcontentmthlybestperfs19 = MonthlyBestPerformer::where('status', '1')->where('category', '>=', 19)->where('category', '<=', 21)->orderBy('category' , 'asc')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $dispcontentmthlybestperfs22 = MonthlyBestPerformer::where('status', '1')->where('category', '>=', 22)->where('category', '<=', 24)->orderBy('category' , 'asc')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $mthlybestperfsmonth = MonthlyBestPerformer::select('content_month')->where('status', '1')->distinct('content_month')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
        $mthlybestperfsinterval = SetInterval::where('carousel', 'Monthly Best Performers')->get();
        return response()->json([
            'result' => $request->result,
            'dispcontentmthlybestperfs3' => $dispcontentmthlybestperfs3,
            'dispcontentmthlybestperfs10' => $dispcontentmthlybestperfs10,
            'dispcontentmthlybestperfs6' => $dispcontentmthlybestperfs6,
            'dispcontentmthlybestperfs12' => $dispcontentmthlybestperfs12,
            'dispcontentmthlybestperfs9' => $dispcontentmthlybestperfs9,
            'dispcontentmthlybestperfs16' => $dispcontentmthlybestperfs16,
            'dispcontentmthlybestperfs19' => $dispcontentmthlybestperfs19,
            'dispcontentmthlybestperfs22' => $dispcontentmthlybestperfs22,
            'mthlybestperfsmonth' => $mthlybestperfsmonth,
            'mthlybestperfsinterval' => $mthlybestperfsinterval
        ]);
    }


    public function display_prodcontent_prodlineeffmonitoring(){

    $dispprodlineeffmon = ProdLineEffMonitoring::where('status', '1')->orderBy('line')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
    $prodlineeffmontarget = ProdLineEffMonitoring::select('target')->where('status', '1')->distinct('target')->get();
    // $prodlineeffmonmonth = ProdLineEffMonitoring::select('content_month')->where('status', '1')->distinct('content_month')->get();
    $prodlineeffmonmonth = ProdLineEffMonitoring::select('content_month')->where('status', '1')->distinct('content_month')->where('start_date', '<=', Carbon::now())->where('expiry_date', '>=', Carbon::now())->get();
    $prodlineeffmoninterval = SetInterval::where('carousel', 'Production Line Efficiency Monitoring')->get();
    // return $prodlineeffmontarget;
    return response()->json([
        'dispprodlineeffmon' => $dispprodlineeffmon,
        'prodlineeffmontarget' => $prodlineeffmontarget,
        'prodlineeffmonmonth' => $prodlineeffmonmonth,
        'prodlineeffmoninterval' => $prodlineeffmoninterval
        ]);
    }
}
