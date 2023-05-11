<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EmergencyContactsController extends Controller
{

    public function addEmergencyContact(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $user = Auth::user(); // Get the authenticated user

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|digits:11', // assuming phone numbers are 11 digits
            'relationship' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Find the emergency contact user by their phone number
        $emergencyContact = User::where('phone_number', $request->phone_number)->first();

        if (!$emergencyContact) {
            return response()->json(['error' => 'Emergency contact not found'], 404);
        }

        // Attach the emergency contact to the user
        $user->emergency_contacts()->attach($emergencyContact->id, ['relationship' => $request->relationship]);

        // Return a success response
        return response()->json(['message' => 'Emergency contact added successfully'], 200);
    }



public function show(Request $request)
{
    $user = Auth::user();
    $emergencyContacts = $user->emergency_contacts;

    return response()->json([
        'status' => 'success',
        'message' => 'Emergency contact shown successfully',
        'emergency_contact' => $emergencyContacts,
    ]);
}




    public function delete (Request $request)
    {
        $validatedData = $request->validate([
            'phone_number' => 'required'
        ]);

        if (Auth::check()) {
            $emergencyContact = User::where('phone_number', $validatedData['phone_number'])->first();
            $user = Auth::user()->id;

            if (!$emergencyContact) {
                return response()->json(['success' => false, 'message' => 'Emergency contact not found'], 404);
            }

            $user = Auth::user()->id;
            $emergencyContacts = UserUser::where('user_id', $user)->where('emergency_contact_id', $emergencyContact->id)->first();
            $users = UserUser::where('user_id', $user)->where('emergency_contact_id', $emergencyContact->id)->delete();
        }

        return response()->json(['success' => true, 'message' => 'Emergency contact deleted from user', 'emergencyContact' => $emergencyContact]);
    }


}
