<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use GuzzleHttp\Psr7\Response;

class WebsiteController extends Controller
{
    public function Home(){
        return view('Home');
    }



    public function postOrder(Request $request){
        $order = new Order();
        $order->name = $request->name;
        $order->Phone_NO = $request->Phone_NO;
        $order->Address = $request->Address;
        $order->save();
        return redirect()->back();

    }

    
}
