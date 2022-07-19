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

        if ($request->s) {

            list($w1, $w2) = explode(' ', $request->s . ' ');

            $animalsDir = [DB::table('animals')
                ->join('colors', 'colors.id', '=', 'animals.color_id')
                ->select('colors.*', 'animals.*')
                ->where('colors.title', 'like', '%'.$w1.'%')
                ->where('animals.name', 'like', '%'.$w2.'%')
                // ->orWhere(function($query) use ($w1, $w2) {
                //     $query->where('colors.title', 'like', '%'.$w2.'%')
                //         ->where('animals.name', 'like', '%'.$w1.'%');
                // })
                ->orWhere(fn($query) => $query
                ->where('colors.title', 'like', '%'.$w2.'%')
                ->where('animals.name', 'like', '%'.$w1.'%'))
                ->orWhere(fn($query) => $query
                ->where('animals.name', 'like', '%'.$w2.'%')
                ->where('animals.name', 'like', '%'.$w1.'%'))
                ->orderBy('animals.name', 'asc')
                ->get(), 'default'];
            $filter = 0;
        }
        else {
            if (!$request->color_id) {
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
                                    // ->offset(4)
                                    // ->limit(5)
                                    ->get(), 'animal-desc'],
                    
                    default => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('animals.*', 'colors.*')
                                    ->get()->shuffle(), 'default']
                };
                $filter = 0;
            } 
            else {
                $animalsDir = match($request->sort) {
                    'color-asc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.*')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('colors.title', 'asc')
                                    ->get(), 'color-asc'],
                    'color-desc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.*')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('colors.title', 'desc')
                                    ->get(), 'color-desc'],

                    'animal-asc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.*')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('animals.name', 'asc')
                                    ->orderBy('colors.title', 'asc')
                                    ->get(), 'animal-asc'],
                    'animal-desc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.*')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('animals.name', 'desc')
                                    ->orderBy('colors.title', 'asc')
                                    ->get(), 'animal-desc'],
                    
                    default => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('animals.*', 'colors.*')
                                    ->where('animals.color_id', $request->color_id)
                                    
                                    ->get()->shuffle(), 'default']
                };
                $filter = (int) $request->color_id;
            }
        }

    //    dd($animals);
           
        return view('front.index', [
            'animals' => $animalsDir[0],
            'sort' => $animalsDir[1],
            'colors' => Color::all(),
            'filter' => $filter,
            's' => $request->s ?? ''
        ]);
    }
}