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


    public function CarStore(Request $request)
    {
        $validatedData = $request->validate([
            'plate_NO' => 'required',
            'model' => 'required',
            'color' => 'required',
        ]);

        $car = Car::where('plate_NO', $validatedData['plate_NO'])->first();
        if (Auth::check()) {
            $user = Auth::user();
        if ($car) {
            User_Car::create([
                'user_id' => Auth::user()->id,
                'car_id' => $car->id,
            ]);
        } else {
            $car = Car::create([
                'plate_NO' => $validatedData['plate_NO'],
                'model' => $validatedData['model'],
                'color' => $validatedData['color'],
            ]);

            User_Car::create([
                'user_id' => Auth::user()->id,
                'car_id' => $car->id,
            ]);
        }
            return response()->json([
                'message' => 'Car information created successfully',
                'data' => $car,
            ],200);
        }
    else{
        return response()->json([
            'message' => 'you are not logged in',
        ],401);
    }
    }









    public function CarUpdate(Request $request, $id)
    {
        $user=Auth::user()->id;
        $car = Car::find($user);
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



//     public function CarUpdate(Request $request)
// {
//     $validatedData = $request->validate([
//         'plate_NO' => 'required',
//         'model' => 'required',
//         'color' => 'required',
//     ]);

//     $user = Auth::user();
//     $car = Car::where('plate_NO', $request->plate_NO)->first();

//     if (!$car) {
//         $car = Car::create([
//             'plate_NO' => $validatedData['plate_NO'],
//             'model' => $validatedData['model'],
//             'color' => $validatedData['color'],
//         ]);
//     } else {
//         $car->plate_NO = $validatedData['plate_NO'];
//         $car->model = $validatedData['model'];
//         $car->color = $validatedData['color'];
//         $car->save();
//     }

//     $user->cars()->syncWithoutDetaching($car->id);

//     return response()->json([
//         'status' => 'success',
//         'message' => 'Car updated successfully',
//         'car' => $car,
//     ],200);
// }


    // public function CarDelete()
    // {
    //     $user=Auth::user()->id;
    //     $car = Car::find($user);
    //     if($car->delete()){
    //         User_Car::where('car_id',$car->id)->delete();
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'car deleted successfully',
    //     ]);
    // }

    public function CarDelete(Request $request)
    {
        $user = Auth::user();
        $car = Car::where('plate_NO', $request->plate_NO)->first();
        if(!$car) {
            return response()->json([
                'status' => 'error',
                'message' => 'car not found',
            ], 404);
        }
        if($car->users()->where('user_id', $user->id)->exists()) {
            $car->users()->detach($user->id);
        }
        if($car->users()->exists()) {
            return response()->json([
                'status' => 'success',
                'message' => 'car relation removed successfully',
            ]);
        } else {
            $car->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'car deleted successfully',
            ]);
        }
        
    }


                //   public function CarShow()
                //  {
                //   $user=Auth::user()->id;
                //    $car = Car::find($user);
                //     return response()->json([
                //     'status' => 'success',
                //     'message' => 'car show successfully',
                //     'car' => $car,
                //       ]);
                //  }

                public function CarShow()
                {
                    $user = Auth::user();
                    $cars = $user->cars;

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Cars shown successfully',
                        'cars' => $cars,
                    ]);
                }


}
