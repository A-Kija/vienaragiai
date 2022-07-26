<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->get();

        
        return view('orders.index', ['orders' => $orders]);
    }
    
    
    
    
    
    
    public function add(Request $request)
    {
        // dd($request->all());

        $order = new Order;

        $order->count = $request->animals_count;
        $order->animal_id = $request->animal_id;
        $order->user_id = Auth::user()->id;

        $order->save();

        return redirect()->route('my-orders');

    }

    public function showMyOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();



        return view('front.orders', ['orders' => $orders]);
    }
}
