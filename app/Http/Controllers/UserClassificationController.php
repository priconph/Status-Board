<?php

namespace App\Http\Controllers;

use App\Model\UserClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;

class UserClassificationController extends Controller
{
    //

    public function get_user_classifications(Request $request){
    	$user_classifications = UserClassification::all();

    	return response()->json(['user_classifications' => $user_classifications]);
    }
}
