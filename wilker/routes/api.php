<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RouteController;

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


route::post('v1/auth/login/',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
    route::get('v1/auth/logout',[AuthController::class,'logout']);
    route::resource('v1/place',PlaceController::class);
    route::resource('v1/schedule',ScheduleController::class);
    route::resource('v1/route',RouteController::class);
    route::get('v1/route/search/{from_place_id}/{to_place_id}',[ScheduleController::class,'searchRoute']);
});
