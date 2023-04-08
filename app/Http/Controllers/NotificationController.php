<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Emergency_contact;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Facades\Vonage;
use Vonage\SMS\Message\SMS;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmergencyNotification;

class NotificationController extends Controller
{
   //shaghala bas el message mesh betwsl
      public function sendEmergencyMessage(Request $request)
       {
        // Get the authenticated user
        $user = Auth::user();

        // Get the emergency contacts for the user
        $emergencyContacts = $user->emergencyContacts;

        // Send an SMS notification to each emergency contact
        foreach ($emergencyContacts as $contact) {
            Notification::route('Vonage', $contact->phone_number)
                ->notifyNow(new EmergencyNotification($user));
        }

        return response()->json(['message' => 'Emergency contact notifications sent.']);
    }

    
}







