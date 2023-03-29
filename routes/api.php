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


  Route::post('Register',[RegisterController::class,'Register']);

  Route::post('userLogin',[UserController::class,'userLogin']);
 // Route::post('userRegister',[UserController::class,'userRegister']);
 Route::get('/showdata', [UserController::class, 'showData']);
 Route::put('/updateData', [UserController::class, 'updateData']);


 Route::post('/medical-info', [MedicalController::class, 'medicalCase']);

    Route::post('CarStore',[CarController::class,'CarStore']);
    Route::get('car-list',[CarController::class,'carList']);
    Route::put('CarUpdate/{id}',[CarController::class,'CarUpdate']);
    Route::delete('carDelete',[CarController::class,'carDelete']);
    Route::get('carShow',[CarController::class,'carShow']);

    Route::post('sendNotification', [EmergencyContactsController::class, 'sendNotification']);
    Route::post('/user/action', [EmergencyContactsController::class, 'handleUserAction']);

  Route::post('store_emergency_contact', [EmergencyContactsController::class, 'store']);
//  Route::post('eme', [EmergencyContactsController::class, 'save']);



 Route::get('emergency-contacts-show', [EmergencyContactsController::class, 'showw']);
// Route::get('emergency-contacts-show', [EmergencyContactsController::class, 'index']);
  Route::post('/send-notification', [NotificationController::class, 'send']);
//  Route::get('emergency-contacts-show', [EmergencyContactsController::class, 'show']);

  //  Route::get('emergency-contacts-edit/{id}', [EmergencyContactsController::class, 'edit']);
  Route::post('showw',[RegisterController::class,'test2']);
  Route::put('emergency/{id}',[EmergencyContactsController::class,'update']);
  Route::post('emergency-contact-delete',[EmergencyContactsController::class,'delete']);
  Route::post('emergency-contact-get',[EmergencyContactsController::class,'get']);





