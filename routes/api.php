<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmergencyContactsController;
use App\Http\Controllers\NotificationController;
use App\Notifications\EmergencyNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\EmergencyContact;
use App\Models\User;
use Illuminate\Notifications\Notification as NotificationsNotification;

Route::post('/notification-response', function (Request $request) {
    // Get the authenticated user.
    $user = Auth::user();

    // Check whether the user's response was positive or negative.
    $response = $request->input('response');
    if ($response == 'true') {
        // Do nothing, the user is okay.
      } else {
        // Schedule an emergency notification to be sent in 1 minute.
        $emergencyContacts = $user->emergencyContacts;
        foreach ($emergencyContacts as $contact) {
            Notification::route('sms', $contact->phone_number)
                ->notify((new EmergencyNotification($user, $contact))->delay(now()->addMinute()));
        }
    }

    // Return a response to the user.
    return response()->json(['message' => 'Notification response recorded.']);
});

Route::get('/notify-emergency-contact', function () {
    $user = App\Models\User::find(Auth::user()->id);
    $emergencyContact = $user->emergencyContacts()->first();
    $notification = new EmergencyNotification($user, $emergencyContact);
    $user->notify($notification);
    return 'Emergency notification sent.';
});
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
 //user routes
 Route::get('/showdata', [UserController::class, 'showData']);
 Route::put('/updateData', [UserController::class, 'updateData']);

  //medical routes
 Route::post('/medical-info', [MedicalController::class, 'medicalCase']);
   //car routes
    Route::post('CarStore',[CarController::class,'CarStore']);
    Route::put('CarUpdate',[CarController::class,'CarUpdate']);
    Route::delete('carDelete',[CarController::class,'carDelete']);
    Route::get('carShow',[CarController::class,'carShow']);


   //emergency contacts routes
   Route::post('enter_emergency_contact', [EmergencyContactsController::class, 'store']); //store array of emergency contacts
  Route::post('store_emergency_contact', [EmergencyContactsController::class, 'store_emergency_contact']); //store one emergency contact
  Route::delete('emergency-contact-delete',[EmergencyContactsController::class,'delete']);
  Route::get('emergency-contacts-show', [EmergencyContactsController::class, 'show']);

    //notification routes
    // Route::post('/user/action', [EmergencyContactsController::class, 'handleUserAction']);
//feedback route
Route::post('feedback',[UserController::class,'feedback']);


//Route::post('message', [EmergencyContactsController::class, 'messages']);
Route::Get('SendSms', [NotificationController::class, 'SendSms']);

Route::Post('sendEmergencyMessage', [NotificationController::class, 'sendEmergencyMessage']);
Route::get('/send-emergency-notification', function () {
    $user = Auth::user();
    $emergencyContacts = $user->emergencyContacts;
    if (!$emergencyContacts) {
        return response()->json(['message' => 'Emergency contact not found'], 404);
    }
    foreach ($emergencyContacts as $emergencyContact) {
        $emergencyContact->notify(new EmergencyNotification);
    }
    return response()->json([
        'message' => 'Emergency notification sent successfully',
    ]);
});
