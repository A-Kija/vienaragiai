<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumaController extends Controller
{
    public function suma($a, $b)
    {
        return $a + $b;
    }
}
