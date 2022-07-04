<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function barsukas(Request $request)
    {
        dump($request->kiekis);
        dump($request->spalva);
        return 'Valio barsukams';
    }


    public function briedis(Request $request, $aidysas)
    {

        dump($aidysas);
        return 'Valio briedams';
    }

}
