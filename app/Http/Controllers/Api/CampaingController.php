<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;

use Hash;
use Carbon\Carbon;
use Auth;
use Validator;

class CampaingController extends Controller
{
    //
    public function createCampaing(Request $request)
    {
        # code...
         $validator = Validator::make($request->all(), [
           'youtube_link'=> 'required|unique:campaigns',
        ]);
         //validation check
        if($validator->fails()){

              return response()->json([
                        'success'=>false,
                        'message'=>['Error'],
                        'data'=> $validator->errors()->all()
                    ],401);
            
        }
        else{

            $all_input              = $request->all();
            $all_input['user_id']  = Auth::user()->id;
            //
            Campaign::create($all_input);
            //
            return response()->json([
                        'success'=>true,
                        'message'=>['campaing successfully created.'],
                        'data'=>[]
             ]);
        }
    }
}
