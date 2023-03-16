<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['userLogin', 'userRegister']]);
    }

    public function userLogin(Request $request)
    {

        //  $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);
        // $credentials = $request->only('email', 'password');

        // $token = Auth::attempt($credentials);
        // if (!$token ) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Unauthorized',
        //     ], 401);
        // }
        // $User = Auth::User();
        // return response()->json([
        //         'status' => 'success',
        //         'User' => $User,
        //         'authorisation' => [
        //             'token' => $token,
        //             'type' => 'bearer',
        //         ]
        //     ]);

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


}


