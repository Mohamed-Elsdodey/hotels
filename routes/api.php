<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'settings'], function () {


    Route::get('how_to_get_points',[\App\Http\Controllers\Api\HowToGetPointApiController::class,'index']);
    Route::get('how_to_redeem',[\App\Http\Controllers\Api\HowToRedeemApiController::class,'index']);
    Route::get('offers',[\App\Http\Controllers\Api\OfferApiController::class,'index']);
    Route::get('clients',[\App\Http\Controllers\Api\ClientApiController::class,'index']);
    Route::get('user_types_by_client',[\App\Http\Controllers\Api\UserTypeApiController::class,'index']);
    Route::get('charities',[\App\Http\Controllers\Api\CharityApiController::class,'index']);
    Route::get('stores',[\App\Http\Controllers\Api\StoreApiController::class,'index']);
    Route::get('levels_by_client',[\App\Http\Controllers\Api\LevelApiController::class,'index']);
    Route::get('governorates',[\App\Http\Controllers\Api\GovernorateApiController::class,'index']);
    Route::get('points',[\App\Http\Controllers\Api\PointApiController::class,'index']);





});

