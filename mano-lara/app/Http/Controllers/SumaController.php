<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumaController extends Controller
{
    public function suma($a = 0, $b = 0)
    {
        $ab =  $a + $b;

        return view('suma', ['rezultatas' => $ab]);
    }
}
