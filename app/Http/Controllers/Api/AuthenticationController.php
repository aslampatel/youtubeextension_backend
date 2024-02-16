<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
 
use Hash;
use Carbon\Carbon;
use Auth;
use Validator;

class AuthenticationController extends Controller
{
    //
    public function login(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(), [
          'email'=> 'required|email',
        ]);
         //validation check
        if($validator->fails()){
              return response()->json([
                        'success'=>false,
                        'message'=>['Error'],
                        'data'=> $validator->errors()->all()
                    ],401);
            
        }
        //======== Auth attempt ====
        $UserAuth = User::where('email',$request->email)->first();
        if(!empty($UserAuth))
        { 
                //
                $token                    = $UserAuth->createToken('youtubeexclient')->accessToken;
                $data['token_type']       = "Bearer";
                $data['user']             = $UserAuth;
                //==================================================
                return response()->json([
                        'success'=>true,
                        'message'=>['Login successfully'],
                        'data'=>[
                            'token_type' => 'Bearer',
                            'token' => $token,
                            'user'  => $UserAuth,     
                        ]
                    ]);
           
        } 
        else{

                User::create([
                    'email'                 => $request->email,
                    'name'                  => $request->name,
                    'affiliated_code'       => Str::random(6),
                    'affiliated_used_code'  => $request->affiliated_used_code
                ]);

                $UserAuth = User::where('email',$request->email)->first();
                $token = $UserAuth->createToken('youtubeexclient')->accessToken;
                $data['token_type']       = "Bearer";
                $data['user']             = $UserAuth;

                return response()->json([
                        'success'=>true,
                        'message'=>['Login successfully'],
                        'data'=>[
                            'token_type' => 'Bearer',
                            'token'      => $token,
                            'user'       => $UserAuth,     
                        ]
                    ]);
           
        } 
     


    }
}
