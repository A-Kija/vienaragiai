<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->get();


        return view('orders.index', [
            'orders' => $orders,
            'statuses' => Order::STATUSES
        
        ]);
    }

    public function setStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();
        return redirect()->back();
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


        $orders = $orders->map(function($o) {
            $time = Carbon::create($o->created_at)->setTimezone('Europe/Vilnius');

            // $time->next('Monday')->addHours(12);
            // dd($time);
            $o->time = $time->format('Y-m-d') . '&nbsp;&nbsp;&nbsp' . $time->format('H:i');
            // $o->time = '<script>alert("batai")</script>';
            return $o;
        });


        return view('front.orders', [
            'orders' => $orders,
            'statuses' => Order::STATUSES

        
        ]);
    }
}
