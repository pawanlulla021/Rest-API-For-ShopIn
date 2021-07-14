<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controlapi;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//middleware for api
Route::group(['middleware' => 'auth:sanctum'], function(){
 
 //create with validation
 Route::post('save',[controlapi::class,'create']);
 //update
 Route::put('update',[controlapi::class,'update']);
 //delete
 Route::delete('delete/{id}',[controlapi::class,'delete']);
 //search
 Route::get('search/{name}',[controlapi::class,'search']);  
 //display
 Route::get('data/{id?}',[controlapi::class,'display']);
});


//login Authentication
Route::post('login',[UserController::class,'index']);    

//file upload
Route::post('upload',[controlapi::class,'upload']);



