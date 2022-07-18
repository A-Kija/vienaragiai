<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Color;
use DB;

class FrontController extends Controller
{
    public function index(Request $request) 
    {


        $animalsDir = match($request->sort) {
            'color-asc' => [DB::table('animals')
                            ->join('colors', 'colors.id', '=', 'animals.color_id')
                            ->select('colors.*', 'animals.*')
                            ->orderBy('colors.title', 'asc')
                            ->get(), 'color-asc'],
            'color-desc' => [DB::table('animals')
                            ->join('colors', 'colors.id', '=', 'animals.color_id')
                            ->select('colors.*', 'animals.*')
                            ->orderBy('colors.title', 'desc')
                            ->get(), 'color-desc'],

            'animal-asc' => [DB::table('animals')
                            ->join('colors', 'colors.id', '=', 'animals.color_id')
                            ->select('colors.*', 'animals.*')
                            ->orderBy('animals.name', 'asc')
                            ->orderBy('colors.title', 'asc')
                            ->get(), 'animal-asc'],
            'animal-desc' => [DB::table('animals')
                            ->join('colors', 'colors.id', '=', 'animals.color_id')
                            ->select('colors.*', 'animals.*')
                            ->orderBy('animals.name', 'desc')
                            ->orderBy('colors.title', 'asc')
                            ->get(), 'animal-desc'],
            
            default => [DB::table('animals')
                            ->join('colors', 'colors.id', '=', 'animals.color_id')
                            ->select('animals.*', 'colors.*')
                            ->get()->shuffle(), 'default']
        };

    //    dd($animals);
           
        return view('front.index', [
            'animals' => $animalsDir[0],
            'sort' => $animalsDir[1],
            'colors' => Color::all()
        ]);
    }
}
