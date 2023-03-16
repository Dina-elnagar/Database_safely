<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['CarRegister']]);
    }

    public function CarRegister(Request $request)
    {
        //////////////////////////first try  ***////////////////////////
        // $request->validate([
        //     'plate_NO' => 'required',
        //     'model' => 'required',
        //     'color' => 'required'
        // ]);
        // $car = Car::create([
        //     'plate_NO' => $request->plate_NO,
        //     'model' => $request->model,
        //     'color' => $request->color,
        // ]);
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'car created successfully',
        //     'car' => $car,
        // ]);


     //////////////////////////second try //////////////////////// ***

        // $input = $request->all();
        // $validator = Validator::make($input, [
        // 'plate_NO' => 'required',
        // 'model' => 'required',
        // 'color' => 'required'
        // ]);
        // if($validator->fails()){
        // return $this->sendError('Validation Error.', $validator->errors());
        // }

        // $car = Car::create($input);
        // return response()->json([
        // "success" => true,
        // "message" => "car created successfully.",
        // "car" => $car
        // ],200);

//////////////////////////third try ***////////////////////////

// $this->validate($request, [
//             'plate_NO' => 'required',
//             'model' => 'required',
//             'color' => 'required'
// ]);

// $car = new Car();
// $car->plate_NO = $request->plate_NO;
// $car->model = $request->model;
// $car->color = $request->color;
// $car->save();
// return response()->json(
//     [
//     'success' => true,
//     'data' => $car->toArray()
// ]
// );

//////////////////////////fourth try ***////////////////////////
//   $data =   $request->validate( [
//     'plate_NO' => 'required',
//     'model' => 'required',
//     'color' => 'required'
// ]);
// $car = Car::create($data);
// return response()->json([
//     'success' => true,
//     'data' => $car->toArray()
// ]);
   //////////////////////////fifth try ***////////////////////////
   $data = Car::create($this->ValidateData());
    return response()->json([
     'success' => true,
     'data' => $data->toArray()
    ],200);


 }


//tab3 el fifth try
public function ValidateData()
{
    return request()->validate( [
        'plate_NO' => 'required',
        'model' => 'required',
        'color' => 'required'
    ]);

    // $rules = [
    //     'plate_NO' => 'required',
    //     'model' => 'required',
    //     'color' => 'required'
    // ];
    // $validator = Validator::make($request->all(), $rules);
    // if ($validator->fails()) {
    //     return $this->sendError('Validation Error.', $validator->errors());
    // }
}

}
