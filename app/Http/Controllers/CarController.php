<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\User;
use App\Models\User_Car;
use Illuminate\Support\Facades\Validator;


class CarController extends Controller
{


    public function CarRegister(Request $request)
    {
        $validatedData = $request->validate([
            'plate_NO' => 'required',
            'model' => 'required',
            'color' => 'required',
        ]);

        $car =Car::create([
            'plate_NO' => $validatedData['plate_NO'],
            'model' => $validatedData['model'],
            'color' => $validatedData['color'],
        ]);

        User_Car::create([
            'user_id' => Auth::user()->id,
            'car_id' => $car->id,
        ]);

        return response()->json([
            'message' => 'Car information created successfully',
            'data' => $car,
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




    
}
