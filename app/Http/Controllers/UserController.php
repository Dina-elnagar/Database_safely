<?php

namespace App\Http\Controllers;

use App\Models\Medical_case;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_medical_case;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;






class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['userLogin', 'userRegister']]);
    }

    public function userLogin(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json([
                'message' => 'error please check your user name and password and try again',
                'status' => 'false'
            ], 401);
        }
        return $this->createNewToken($token);
        return response()->json([
            'message' => 'login sucessfully',
            'status' => 'true',
            'user' => Auth::guard('api')->user()
        ]);


        }




        public function userRegister(Request $request){
        //DB::beginTransaction();
         $validator = Validator::make($request->all(), [
         'first_name'       => 'required|string|min:3|max:255',
            'last_name'               => 'required|string|min:3|max:255',
             'phone_number'             => 'required|string',
            'email'             => 'required|string|email',
            'password'          => 'required|string',
            'confirm_password'          => 'required|same:password',
            'date_of_birth'          => 'required',
            'gender'            => 'required',
            'Address'           => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

                $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $token = $user->createToken('new token')->accessToken;

        return response()->json([

            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token,
        ], 201);

}


    protected function createNewToken($token)
    {

        return response()->json([
            'message' => 'login sucessfully',
            'status' => 'true',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => Auth::guard('api')->user()
        ]);
    }


    protected function guard()
    {
        return Auth::guard('api');
    }

    public function userLogout()
    {
        $this->guard()->logout();

        return response()->json([
            'message' => 'User successfully signed out',
            'status' => 'true'
        ]);
    }


          public function showData(Request $request)
        {
           // Get the authenticated user
           $user = Auth::user();
         $medicalCase = $user->Medical_cases->first();
         if ($medicalCase) {
          return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone_number' => $user->phone_number,
            'Address' => $user->Address,
            'blood_type' => $medicalCase->blood_type,
            'another_health_problem' =>  $medicalCase->another_health_problem,
          ]);
          } else {
          return response()->json(['message' => 'No related medical case found for user']);
          }

         }


    public function updateData(Request $request)
    {
      //  Validate the request data
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'Address' => 'required|string',
           // 'phone_number' => 'required',
           // 'blood_type' => 'required|string',
            'another_health_problem' => 'required|string',
        ]);

        // Update the user data
        $user = Auth::user();
        //$user-> update($request->only('first_name', 'last_name', 'Address','blood_type'));
        $user ->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'Address' => $request->Address,
          //  'phone_number' => $request->phone_number,
        ]);
        // Update the medical case data
        $medicalCaseData  = [
         //   'blood_type' => $request->input('blood_type'),
            'another_health_problem' => $request->input('another_health_problem')
        ];
        foreach ($user->Medical_cases as $Medical_case) {
            $Medical_case->update([
             //   'blood_type' => $request->input('blood_type'),
                'another_health_problem' => $request->input('another_health_problem')
            ]) ;
        }
        return response()->json([
            'message' => 'User data updated successfully',
            'user' => $user,
            'medicalCase' => $medicalCaseData ,
        ]);
       }

       public function feedback (Request $request)
       {

    $user = Auth::user(); // Get the authenticated user

    // Validate the input data
    $validator = Validator::make($request->all(), [
        'phone_number' => 'required|string',
        'feedback' => 'nullable|string|min:3|max:255',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422);
    }
/** */
    // Check if the user with the specified phone number exists
    $existingUser = User::where('phone_number', $request->input('phone_number'))->first();
    if (!$existingUser) {
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    /*Check if the user with the specified phone number matches the authenticated user
    if ($existingUser->id !== $user->id) {
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }
/** */
    // Update the user's information
//    $existingUser->name = $request->input('name', $existingUser->name);
// $existingUser->feedback = $request->input('feedback', $existingUser->feedback);
DB::table('feedback')->insert([
    'users_id' => $user->id,
    'feedback' => $request->feedback,
]);


    $existingUser->save();

    return response()->json([
        'message' => 'thanks for your Feedback',

    ], 200);
}

       }




