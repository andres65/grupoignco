<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TareasapiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TareasapiController::class)->group(function(){
    Route::post('login','loginUser');
});

Route::controller(TareasapiController::class)->group(function(){
    Route::get('user','getUserDetail');
    Route::get('logout','userLogout');
    Route::get('listtask','listTask');
    Route::post('createtask','createTask');
    Route::put('updatetask/{id}','updatetask');
    Route::delete('deletetask/{id}','deletetask');
})->middleware('auth:api');

//Route::put('updatetask/{id}', 'App\Http\Controllers\API\TareasapiController@updatetask')->middleware('auth:api');
