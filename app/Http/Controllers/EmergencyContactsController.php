<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Emergency_contact;
use App\Models\User;
use App\Models\User_emergency_contact;
use App\Models\Emergency_message;
use App\Models\User_emergency_message;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Twilio\Rest\Client;

class EmergencyContactsController extends Controller
{



//     public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'phone_number' => 'required|array',
//         'relationship' => 'required|array',
//         'phone_number.*' => 'required|string',
//         'relationship.*' => 'required|string'
//     ]);

//     if (Auth::check()) {
//         $user = Auth::user();
//         $success = true; // Initialize a success flag

//         // Loop through each phone number and relationship and validate them
//         foreach ($validatedData['phone_number'] as $key => $phoneNumber) {
//             // Validate phone number and relationship
//             $validator = Validator::make([
//                 'phone_number' => $phoneNumber,
//                 'relationship' => $validatedData['relationship'][$key]
//             ], [
//                 'phone_number' => 'required|string',
//                 'relationship' => 'required|string'
//             ]);

//             // If validation fails, set success flag to false and break the loop
//             if ($validator->fails()) {
//                 $success = false;
//                 break;
//             }
//         }

//         // If all validation passes, create or update the emergency contacts
//         if ($success) {
//             foreach ($validatedData['phone_number'] as $key => $phoneNumber) {
//                 $emergencyContact = Emergency_contact::firstOrCreate(['phone_number' => $phoneNumber]);
//                 DB::table('user_emergency_contacts')->insert([
//                     'user_id' => $user->id,
//                     'emergency_contact_id' => $emergencyContact->id,
//                     'relationship' => $validatedData['relationship'][$key],
//                 ]);
//             }

//             return response()->json(['success' => true]);
//         } else {
//             return response()->json(['success' => false, 'message' => 'One or more provided phone numbers or relationships are invalid.']);
//         }
//     }

//     return response()->json(['success' => false]);
// }


public function store(Request $request)
{
    $validatedData = $request->validate([
        'phone_number' => 'required|array',
        'relationship' => 'required|array',
        'phone_number.*' => 'required|string',
        'relationship.*' => 'required|string'
    ]);

    if (Auth::check()) {
        $user = Auth::user();
        $success = true; // Initialize a success flag

        // Loop through each phone number and relationship and validate them
        foreach ($validatedData['phone_number'] as $key => $phoneNumber) {
            // Validate phone number and relationship
            $validator = Validator::make([
                'phone_number' => $phoneNumber,
                'relationship' => $validatedData['relationship'][$key]
            ], [
                'phone_number' => 'required|string',
                'relationship' => 'required|string'
            ]);

            // If validation fails, set success flag to false and break the loop
            if ($validator->fails()) {
                $success = false;
                break;
            }
        }

        // If all validation passes, create or update the emergency contacts
        if ($success) {
            foreach ($validatedData['phone_number'] as $key => $phoneNumber) {
                $emergencyContact = Emergency_contact::where('phone_number', $phoneNumber)->first();
                if ($emergencyContact) {
                    // Update the relationship if emergency contact already exists
                    DB::table('user_emergency_contacts')->updateOrInsert(
                        [
                            'user_id' => $user->id,
                            'emergency_contact_id' => $emergencyContact->id
                        ],
                        [
                            'relationship' => $validatedData['relationship'][$key]
                        ]
                    );
                }
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'One or more provided phone numbers or relationships are invalid.']);
        }
    }

    return response()->json(['success' => false]);
}


public function store_emergency_contact(Request $request)
{
  $validatedData=  $request->validate([
        'phone_number' => 'required'
    ]);
    $emergency_contact = Emergency_contact::firstOrCreate($validatedData);
    if (Auth::check()) {
        $user = Auth::user();
        DB::table('user_emergency_contacts')->insert([
            'user_id' => $user->id,
            'emergency_contact_id' => $emergency_contact->id,
            'relationship' => $request->relationship,
        ]);
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
}




// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'phone_number' => 'required|array',
//         'relationship' => 'required|array',
//         'phone_number.*' => 'required|string',
//         'relationship.*' => 'required|string'
//     ]);

//     if (Auth::check()) {
//         $user = Auth::user();

//         // Loop through each phone number and relationship and create or update the emergency contact
//         foreach ($validatedData['phone_number'] as $key => $phoneNumber) {
//             $emergencyContact = Emergency_contact::firstOrCreate(['phone_number' => $phoneNumber]);
//             DB::table('user_emergency_contacts')->insert([
//                 'user_id' => $user->id,
//                 'emergency_contact_id' => $emergencyContact->id,
//                 'relationship' => $validatedData['relationship'][$key],
//             ]);
//         }

//         return response()->json(['success' => true]);
//     }

//     return response()->json(['success' => false]);
// }



public function show(Request $request)
{
    $user = Auth::user();

   $emergency_contacts= $user->emergency_contacts;

    if (!$emergency_contacts) {
        return response()->json(['message' => 'Emergency contact not found'], 404);
    }
    return response()->json(['data' => $emergency_contacts], 200);
}



    public function delete (Request $request)
    {
        $validatedData = $request->validate([
            'phone_number' => 'required'
        ]);

        if (Auth::check()) {
            $emergencyContact = Emergency_contact::where('phone_number', $validatedData['phone_number'])->first();
            $user = Auth::user()->id;

            if (!$emergencyContact) {
                return response()->json(['success' => false, 'message' => 'Emergency contact not found'], 404);
            }

            $user = Auth::user()->id;
            $emergencyContacts = User_emergency_contact::where('user_id', $user)->where('emergency_contact_id', $emergencyContact->id)->first();
            $users = User_emergency_contact::where('user_id', $user)->where('emergency_contact_id', $emergencyContact->id)->delete();
        }

        return response()->json(['success' => true, 'message' => 'Emergency contact deleted from user', 'emergencyContact' => $emergencyContact]);
    }

    public function handleUserAction(Request $request)
    {
        $user = Auth::user();
        $emergency_contacts = $user->emergency_contacts; // Get the emergency contacts for the user

        foreach ($emergency_contacts as $contact) {
            $contact->notify(new InvoicePaid($user));
        }
        return response()->json(['success' => true]);

    }
    // public function messages(Request $request)
    // {
    //     $MessageBird = new \MessageBird\Client('ACCESS_KEY');

    //     $Message = new \MessageBird\Objects\Message();
    //     $Message->originator = 'MessageBird';
    //     $Message->recipients = array(01113770021);
    //     $Message->body = 'This is a test message.';

    //     $MessageBird->messages->create($Message);
    // }

//     public function messages(Request $request)
//      {

//       $client = app(Client::class);

//        $client->messages->create(
//           '+201113770021',
//       [
//         'from' => config('services.twilio.from'),
//         'body' => 'This is a test message.'
//       ]
//      );
//       return response()->json(['success' => true, 'message' => 'Message sent']);
//      }
// }


}
