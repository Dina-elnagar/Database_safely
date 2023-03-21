<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Emergency_contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmergencyContactsController extends Controller
{ 
    /* first time
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Create new contact
        $contact = Contact::create([
            'contact_name' => $request->contact_name,
        ]);

        // Create new phone number
        $phoneNumber = PhoneNumber::create([
            'phone_number' => $request->phone_number,
            'contact_id' => $contact->id,
        ]);

        if ($request->isMethod('get')) {
        return response()->json([
            'message' => 'Contact and phone number added successfully',
            'data' => [
                'contact' => $contact,
                'phone_number' => $phoneNumber,
            ],
            
        ]);
    }
    }

/*
    function list (){


        return Emergency_contact::all() ;
    }

/*** */
public function index()
{
 //  $contacts = Emergency_contact::all();
  //  return response()->json(['contacts' => $contacts]);

// return Emergency_contact::all();
 // return contact::all();
/*
  if ($request->isMethod('get')) {
    return response()->json([
        'contact name' => $Emergency_contact->contact_name,
        'phone number' => $Emergency_contact->first_name,

    ]);
}

 }
 / */
}
/*secound try
public function store(Request $request)
{
    $validatedData = $request->validate([
        'contact_name' => 'required|max:255',
        'phone_number' => 'required|digits_between:10,14'
    ]);

    $emergencyContact = new EmergencyContact;
    $emergencyContact->contact_name = $validatedData['contact_name'];
    $emergencyContact->phone_number = $validatedData['phone_number'];
    $emergencyContact->save();

    return response()->json(['message' => 'Emergency contact saved successfully.']);
}

public function show(EmergencyContact $emergencyContact)
{
    return response()->json(['emergency_contact' => $emergencyContact]);
}
//*** */


public function store(Request $request)
{
$validatedData = $request->validate([
    'contact_name' => 'required',
    'phone_number' => 'required',
]);


$emergencycontact= Emergency_contact::create([
    'contact_name' => $request->contact_name,
    'phone_number' => $request->phone_number,
]);
// return response()->json(['message' => 'Emergency contact saved successfully.'   'data'=> $emergencycontact]);

/** */
}


/** */

}
