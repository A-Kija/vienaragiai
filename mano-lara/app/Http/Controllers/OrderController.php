<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->all());

        $order = new Order;

        $order->count = $request->animals_count;
        $order->animal_id = $request->animal_id;
        $order->user_id = Auth::user()->id;

        $order->save();

    }
}
