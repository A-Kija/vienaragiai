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

    public function skirtumas(Request $request)
    {
        $rodyti = $request->session()->get('rezultatas', '');
        return view('post.form', [
            'ro' => $rodyti
        ]);
    }

    public function skaiciuoti(Request $request)
    {
        $rez = $request->x - $request->y;
        // $request->session()->flash('rezultatas', $rez);
        dump($rez);
        return redirect()->route('forma')->with('rezultatas', $rez);
    }
}
