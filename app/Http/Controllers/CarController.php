<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class CarController extends Controller
{


    public function CarRegister(Request $request)
    {

        $validatedData = $request->validate([
            'plate_NO' => 'required',
            'model' => 'required',
            'color' => 'required',
        ]);
        $carInfo = new Car;
        $carInfo->plate_NO = $validatedData['plate_NO'];
        $carInfo->model = $validatedData['model'];
        $carInfo->color = $validatedData['color'];
        $carInfo->save();

        return response()->json([
            'message' => 'Car information created successfully',
            'data' => $carInfo,
    ]);


    }





    public function ValidateData()
    {
        return request()->validate([
            'plate_NO' => 'required',
            'model' => 'required',
            'color' => 'required'
        ]);
    }

    public function CarList()
    {
        $car = Car::all();
        return response()->json([
            'status' => 'success',
            'message' => 'car list',
            'car' => $car,
        ]);
    }

    public function CarEdit($id)
    {
        $car = Car::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'car edit',
            'car' => $car,
        ]);
    }

    public function CarUpdate(Request $request, $id)
    {
        $car = Car::find($id);
        $car->plate_NO = $request->plate_NO;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->save();
        return response()->json([
            'status' => 'success',
            'message' => 'car updated successfully',
            'car' => $car,
        ]);
    }

    public function CarDelete($id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'car deleted successfully',
        ]);
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plate_NO' => 'required',
            'model' => 'required',
            'color' => 'required',
        ]);

        $carInfo = new Car;
        $carInfo->plate_NO = $validatedData['plate_NO'];
        $carInfo->model = $validatedData['model'];
        $carInfo->color = $validatedData['color'];
        $carInfo->save();

        return response()->json([
            'message' => 'Car information created successfully',
            'data' => $carInfo,
    ]);
    }
}
