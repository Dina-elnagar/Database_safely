<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Medical_case;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User_medical_case;
use App\Models\User_Car;
use App\Models\Emergency_contact;
use App\Models\User_emergency_contact;





class RegisterController extends Controller
{
    public function Register(Request $request){

       //  $validator = Validator::make($request->all(), [
       $request->validate([
        //user data
         'first_name'       => 'required|string|min:3|max:255',
            'last_name'               => 'required|string|min:3|max:255',
             'phone_number'             => 'required|string',
            'email'             => 'required|string|email',
            'password'          => 'required|string',
            'confirm_password'          => 'required|same:password',
            'date_of_birth'          => 'required',
            'gender'            => 'required',
            'Address'           => 'required|string',
            //medical data
            'blood_type' => 'required|string',
            'blood_pressure' => 'required|string',
            'diabetes' => 'nullable',
            'another_health_problem' => 'nullable',
            //car data
            'plate_NO' => 'required',
            'model' => 'required',
            'color' => 'required',
            //emergency contact
            // 'contact_name'=> 'required',
            // 'phone_number'=> 'required',
            // 'relationship'=> 'required',
            
        ]);


        DB::transaction(function () use ($request){
          //user data
        $user = User::create([
           'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirm_password' => bcrypt($request->confirm_password),
            'date_of_birth' => $request->date_of_birth,
            'gender'=>$request-> gender,
            'Address' => $request->Address,

        ]);
        // car data
        $car = Car::create([
            'plate_NO' => $request->plate_NO,
            'model' => $request->model,
            'color' => $request->color,
         ]);
         // medical data
         $medicalInfo = Medical_case::create([
            'blood_type' => $request->blood_type,
            'blood_pressure' => $request->blood_pressure,
            'diabetes' => $request->diabetes,
            'another_health_problem' => $request->another_health_problem,

         ]);
            //emergency contact
         $emergencycontact= Emergency_contact::create([
            // 'contact_name' => $request->contact_name,
            // 'phone_number_emergemncy' => $request->phone_number_emergemncy,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);
         // user medical data
         User_Car::create([
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
       // user medical data
       User_medical_case::create([
           'user_id' => $user->id,
           'medical_case_id' => $medicalInfo->id,
       ]);
        // user emergency contact
        // User_emergency_contact::create([
        //         'user_id' => $user->id,
        //         'emergency_contact_id' => $emergencycontact->id,
        //         'relationship' => $request->relationship,
        //     ]);

        DB::commit();
       });

       return response()->json([
        'message' => 'User successfully registered',

    ], 201);


}






}

