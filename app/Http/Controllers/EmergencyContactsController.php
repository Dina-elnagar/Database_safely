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

public function save (Request $request){

  //  $emergencyContact = EmergencyContact::find($id)

    // Check if the phone number is unique
  //  $existingContact = emergency_contact::where('phone_number', $validatedData['phone_number'])->first();
    if     ($emergencyContact = Emergency_contact::find($id))    {
        // Phone number already exists, return the contact saved 
        User_emergency_contact::create([
            'user_id' => $user->id,
           'emergency_contact_id' => $emergencycontact->id,
           'relationship' => $request->relationship,
       ]);
        return response()->json(['saved' => 'emergency contact saved'], 400);
        
       
    };
}
public function store(Request $request)
{
    $user = Auth::user();

    $emergencycontact= Emergency_contact::create([
        // 'contact_name' => $request->contact_name,
       //  'phone_number_emergemncy' => $request->phone_number_emergemncy,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone_number' => $request->phone_number,
    ]);

       User_emergency_contact::create([
                'user_id' => $user->id,
                'emergency_contact_id' => $emergencycontact->id,
                'relationship' => $request->relationship,
            ]);
            return response()->json([ 'message' => 'emergencyContact added successfully',], 200);


/** */
}


/** */
public function handleUserAction(Request $request)
{
    $user = Auth::user();
    $emergency_contacts = $user->emergency_contacts; // Get the emergency contacts for the user

    foreach ($emergency_contacts as $contact) {
        $contact->notify(new InvoicePaid($user));
    }
    return response()->json(['success' => true]);

}
/*
public function save (Request $request){


// Check if the phone number is unique
$existingContact = EmergencyContact::where('phone_number', $validatedData['phone_number'])->first();
if ($existingContact) {
    // Phone number already exists, return the contact saved 
    User_emergency_contact::create([
        'user_id' => $user->id,
       'emergency_contact_id' => $emergencycontact->id,
       'relationship' => $request->relationship,
   ]);
    return response()->json(['saved' => 'emergency contact saved'], 400);
}
}
/*** */

/* Check if the phone number is unique
$existingContact = EmergencyContact::where('phone_number', $validatedData['phone_number'])->first();
if ($existingContact) {
    // Phone number already exists, return the contact saved 
    User_emergency_contact::create([
        'user_id' => $user->id,
       'emergency_contact_id' => $emergencycontact->id,
       'relationship' => $request->relationship,
   ]);
    return response()->json(['saved' => 'emergency contact saved'], 400)/*** */
    public function show(Request $request)
{
       $user=Auth::user()->id;
        $emergencyContact = Emergency_contact::find($phone_number);
        return response()->json($emergencyContact);
        if (!$emergencyContact) {
            return response()->json(['message' => 'Emergency contact not found'], 404);
        }
    
        /*
    if (!$emergencyContact) {
        return response()->json(['message' => 'Emergency contact not found'], 404);
    }
    /** */
 //   return response()->json($emergencyContact);
}
public function showw(Request $request)
{
    $user = Auth::user();
  //  $emergencyContact = $user->Emergency_contact->find();
    $user = User::where('id', $id)->first();

    $emergencyContact = Emergency_contact::find($id);
    if (!$emergencyContact) {
        return response()->json(['message' => 'Emergency contact not found'], 404);
    }
    return response()->json(['data' => $emergencyContact], 200);
}

public function update(Request $request, $id)
    {
        $user=Auth::user()->id;
        $emergencyContact = Emergency_contact::find($user);
        $emergencyContact = Emergency_contact::find($id);
        $emergencyContact->first_name = $request->first_name;
        $emergencyContact->last_name = $request->last_name;
        $emergencyContact->phone_number = $request->phone_number;
        $emergencyContact->save();
        return response()->json([
            'status' => 'success',
            'message' => 'emergencyContact updated successfully',
            'emergencyContact' => $emergencyContact,
        ]);
    }


//emergency contact delete 
/* works for delete contact
    public function delete (Request $request)
{
    $validatedData = $request->validate([
        'phone_number' => 'required'
    ]);


    if (Auth::check()) {
        $user = Auth::user();
        $emergencyContact = Emergency_contact::where('phone_number', $validatedData['phone_number'])->first();
        $user->emergencyContact()->detach($emergencyContact->id);
    
        return response()->json([
            'success' => true,
            'message' => 'emergencyContact delete successfully'
    ]);
    } 
    
    else {
        return response()->json(['error' => 'Emergency contact not found']);
    }
    /** */

    public function delete(Request $request)
{
    $validatedData = $request->validate([
        'phone_number' => 'required'
    ]);

    $emergencyContact = Emergency_contact::where('phone_number', $validatedData['phone_number'])->first();

    if (!$emergencyContact) {
        return response()->json(['success' => false, 'message' => 'Emergency contact not found'], 404);
    }

    if (Auth::check()) {
        $user = Auth::user();
        $user->user_emergency_contacts()->detach($emergencyContact->id);
    }

    return response()->json(['success' => true, 'message' => 'Emergency contact deleted from user']);
}


    public function get (Request $request)
{
    $validatedData = $request->validate([
        'phone_number' => 'required'
    ]);

    $emergencyContact = Emergency_contact::where('phone_number', $validatedData['phone_number'])->first();

    if ($emergencyContact) {
        // Delete the emergency contact
        $emergencyContact->select();

        // Remove any associated user_emergency_contacts entries
      //  DB::table('user_emergency_contacts')->where('emergency_contact_id', $emergencyContact->id)->delete();

        return response()->json([
            'success' => true,
            'emergencyContact' => $emergencyContact,
    ]);
    } else {
        return response()->json(['error' => 'Emergency contact not found']);
    }
}
}


