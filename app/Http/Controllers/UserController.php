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

    // Get the user's medical case
    $medicalCase =$user->Medical_case;
    return response()->json([
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'phone_number' => $user->phone_number,
        'Address' => $user->Address,
        'blood_type' => $medicalCase->pluck( 'blood_type'),
    ]);
    }

    public function editdata(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        // Get the user's medical case
        $medicalCase =$user->Medical_case;
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'Address' => 'required|string|max:255',
            'blood_type' => 'required|string|max:3',
        ]);
        // Update user data
        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'Address' => $validatedData['Address'],
        ]);
        // Update medical case data
        if ($medicalCase) {
            $medicalCase->update(['blood_type' => $validatedData['blood_type']]);
        } else {
            Medical_case::create([
                'user_id' => $user->id,
                'blood_type' => $validatedData['blood_type'],
            ]);
        }

   }


   public function updateData(Request $request)
    {
      //  Validate the request data
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'Address' => 'required|string',
            'blood_type' => 'required|string'
        ]);

        // Update the user data
        $user = Auth::user();
        $user-> update($request->only('first_name', 'last_name', 'Address','blood_type'));
        // Update the medical case data
         $medicalCase= $user->Medical_cas;
        $medicalCase=  DB::update($request->only('blood_type'));
      //  $medicalCase ->update($request->only('blood_type'));

        return response()->json([
            'message' => 'User data updated successfully',
            'user' => $user,
            'medical_case' => $medicalCase,
        ]);
    }

}

