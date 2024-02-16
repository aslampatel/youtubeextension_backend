<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CampaingController;
use App\Http\Controllers\Api\ExtensionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    //
    Route::post('login', [AuthenticationController::class, 'login']);
});
//
Route::group(['namespace' => 'Api', 'prefix' => 'v1','middleware' => ['auth:api']], function () {
    //
    Route::post('create-campaing', [CampaingController::class, 'createCampaing']);
});

Route::group(['namespace' => 'Api', 'prefix' => 'v2','middleware' => ['auth:api']], function () {
    //
    Route::get('campaing-list', [ExtensionController::class, 'getCampaingList']);
});
