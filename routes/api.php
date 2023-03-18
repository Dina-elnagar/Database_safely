<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\RegisterController;


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

  Route::post('userLogin',[UserController::class,'userLogin']);
  Route::post('userRegister',[UserController::class,'userRegister']);
  Route::get('show',[UserController::class,'show']);
  Route::post('/medical-info', [MedicalController::class, 'medicalCase']);
  Route::post('car',[CarController::class,'carRegister']);
Route::get('show-data',[UserController::class,'showEditData']);
Route::put('edit-data',[UserController::class,'showEditData']);
  Route::match(['get'], '/show-edit-data',
  [UserController::class]);
  Route::post('Register',[RegisterController::class,'Register']);
