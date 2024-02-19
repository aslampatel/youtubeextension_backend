<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;
use App\Models\CampaingUser;
use App\Models\Wallet;

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
        

            $user_id        = Auth::user()->id;
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
        

            $user_id         = Auth::user()->id;
            $campaign_id     = $request->campaign_id;
            //
            $campaingdata    =  Campaign::where('id',$campaign_id)->first();
            $coin            =   $campaingdata->used_coin;
            //
            $campainList =  CampaingUser::create([
                    "user_id"       => $user_id,
                    "campaign_id"   => $campaign_id,
                    "owner_id"      => $campaingdata->user_id,
                    "coin"          => $coin,
            ]);

            Wallet::create([
                "user_id"       => $user_id,
                "campaign_id"   => $campaign_id,
                "coin"          => $coin,
                "type"          => "C",
                // "transiction_id"=>,
                "coin_type"=>'reward',
            ]);

            Wallet::create([
                "user_id"       => $campaingdata->user_id,
                "campaign_id"   => $campaign_id,
                "coin"          => $coin*-1,
                "type"          => "D",
                // "transiction_id"=>,
                "coin_type"=>'debit',
            ]);
            //
            $total_coin = wallet::where(['user_id'=>$user_id])->sum('coin');
            //
            return response()->json([
                        'success'=>true,
                        'message'=>['campaing done successfully.'],
                        'data'=>[
                            'total_coin'=>$total_coin
                        ]
             ]);
        
    }

}
