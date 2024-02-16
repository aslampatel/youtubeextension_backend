<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;

use Hash;
use Carbon\Carbon;
use Auth;
use Validator;

class ExtensionController extends Controller
{
    //
      //
    public function getCampaingList(Request $request)
    {
        # code...
        

            $user_id  = Auth::user()->id;
            //
            $campainList =  Campaign::whereNotIn('user_id',[$user_id])->get();
            //
            return response()->json([
                        'success'=>true,
                        'message'=>['campaing list.'],
                        'data'=>[
                            'campaign_list'=> $campainList
                        ]
             ]);
        
    }
    /**
     *@campaingDone 
     * 
     **/
    public function campaingDone(Request $request)
    {
        # code...
        

            $user_id     = Auth::user()->id;
            //
            $campainList =  Campaign::whereNotIn('user_id',[$user_id])->get();
            //
            return response()->json([
                        'success'=>true,
                        'message'=>['campaing list.'],
                        'data'=>[
                            'campaign_list'=> $campainList
                        ]
             ]);
        
    }

}
