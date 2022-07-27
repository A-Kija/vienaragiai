<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {

       $count = (int) $request->count;
       $id = (int) $request->animalId;

       $cart = session()->get('cart', []);

       dump($cart );

       $cart[] = ['id' => $id, 'count' => $count];


       session()->put('cart', $cart);
       
       
        
        return response()->json([
            'msg' => 'Tu nuostabi arba pastabus'
        ]);
    }

    public function showSmallCart()
    {
        
        $cart = session()->get('cart', []);

        $all = count($cart);

        $html = view('front.cart')->with(['count' => $all])->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function deleteSmallCart()
    {
        session()->put('cart', []);

        return response()->json([
            'msg' => 'Koks nors durnas atsakymas'
        ]);
    }
}
