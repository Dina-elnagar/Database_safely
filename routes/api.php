<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmergencyContactsController;
use App\Http\Controllers\NotificationController;




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

    Route::post('Register',[RegisterController::class,'Register']);//->middleware('auth');



  Route::post('userLogin',[UserController::class,'userLogin']);
 // Route::post('userRegister',[UserController::class,'userRegister']);
 //user routes
    Route::get('/showdata', [UserController::class, 'showData']);
    Route::put('updateData', [UserController::class, 'updateData']);

  //medical routes
    Route::post('/medical-info', [MedicalController::class, 'medicalCase']);
   //car routes
    Route::post('CarStore',[CarController::class,'CarStore'])->middleware('auth');
    Route::put('CarUpdate/{id}',[CarController::class,'CarUpdate']);
    Route::delete('carDelete/{plate_NO}',[CarController::class,'carDelete']);
    Route::get('carShow',[CarController::class,'carShow']);

   //emergency contacts routes
  Route::post('insert', [EmergencyContactsController::class, 'addEmergencyContact']);
  Route::delete('emergency-contact-delete',[EmergencyContactsController::class,'delete']);
  Route::get('emergency-contacts-show', [EmergencyContactsController::class, 'show']);

    //feedback routes
    Route::post('feedback',[UserController::class,'feedback']);

    //notification routes
    Route::post('Store_Notify',[NotificationController::class,'Store']);
    Route::get('Show_Notify',[NotificationController::class,'Show']);
    Route::delete('delete_Notify',[NotificationController::class,'delete']);
