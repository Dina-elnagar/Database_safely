<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MedicalController;

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

  Route::post('CarRegister',[CarController::class,'CarRegister']);

  //Route::post('medicalinfo',[MedicalController::class,'medicalinfo']);
  Route::post('/medical-info', [MedicalController::class, 'medicalCase']);

