<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Color;
use DB;

class FrontController extends Controller
{
    private $perPage = 10;
    
    public function index(Request $request) 
    {

        if ($request->s) {

            list($w1, $w2) = explode(' ', $request->s . ' ');

            $allCount = DB::table('animals')
                ->join('colors', 'colors.id', '=', 'animals.color_id')
                ->select(DB::raw('count(animals.id) AS allAnimals'))
                ->where('colors.title', 'like', '%'.$w1.'%')
                ->where('animals.name', 'like', '%'.$w2.'%')
                ->orWhere(fn($query) => $query
                ->where('colors.title', 'like', '%'.$w2.'%')
                ->where('animals.name', 'like', '%'.$w1.'%'))
                ->orWhere(fn($query) => $query
                ->where('animals.name', 'like', '%'.$w2.'%')
                ->where('animals.name', 'like', '%'.$w1.'%'))
                ->first()->allAnimals;
                       
            $page = $request->page ?? 1;

            $animalsDir = [DB::table('animals')
                ->join('colors', 'colors.id', '=', 'animals.color_id')
                ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
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
                ->offset(($page - 1) * $this->perPage)
                ->limit($this->perPage)
                ->get(), 'default'];
            $filter = 0;
        }
        else {
            if (!$request->color_id) {

                    $allCount = DB::table('animals')
                        ->select(DB::raw('count(animals.id) AS allAnimals, count(DISTINCT(animals.name)) AS allNames'))
                        ->first()->allAnimals;
                    $page = $request->page ?? 1;

                $animalsDir = match($request->sort) {
                    'color-asc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->orderBy('colors.title', 'asc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'color-asc'],
                    'color-desc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->orderBy('colors.title', 'desc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'color-desc'],

                    'animal-asc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->orderBy('animals.name', 'asc')
                                    ->orderBy('colors.title', 'asc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'animal-asc'],
                    'animal-desc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->orderBy('animals.name', 'desc')
                                    ->orderBy('colors.title', 'asc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'animal-desc'],
                    
                    default => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get()->shuffle(), 'default']
                };
                $filter = 0;
            } 
            else {

                $allCount = match($request->sort) {
                    'color-asc' => DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select(DB::raw('count(animals.id) AS allAnimals'))
                                    ->where('animals.color_id', $request->color_id)
                                    ->first()->allAnimals,
                    'color-desc' => DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select(DB::raw('count(animals.id) AS allAnimals'))
                                    ->where('animals.color_id', $request->color_id)
                                    ->first()->allAnimals,

                    'animal-asc' => DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select(DB::raw('count(animals.id) AS allAnimals'))
                                    ->where('animals.color_id', $request->color_id)
                                    ->first()->allAnimals,
                    'animal-desc' => DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select(DB::raw('count(animals.id) AS allAnimals'))
                                    ->where('animals.color_id', $request->color_id)
                                    ->first()->allAnimals,
                    
                    default => DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select(DB::raw('count(animals.id) AS allAnimals'))
                                    ->where('animals.color_id', $request->color_id)
                                    ->first()->allAnimals
                };

                $page = $request->page ?? 1;

                $animalsDir = match($request->sort) {
                    'color-asc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('colors.title', 'asc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'color-asc'],
                    'color-desc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('colors.title', 'desc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'color-desc'],

                    'animal-asc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('animals.name', 'asc')
                                    ->orderBy('colors.title', 'asc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'animal-asc'],
                    'animal-desc' => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('colors.*', 'animals.id AS aid', 'animals.name', 'animals.color_id', 'animals.photo')
                                    ->where('animals.color_id', $request->color_id)
                                    ->orderBy('animals.name', 'desc')
                                    ->orderBy('colors.title', 'asc')
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get(), 'animal-desc'],
                    
                    default => [DB::table('animals')
                                    ->join('colors', 'colors.id', '=', 'animals.color_id')
                                    ->select('animals.*', 'colors.*')
                                    ->where('animals.color_id', $request->color_id)
                                    ->offset(($page - 1) * $this->perPage)
                                    ->limit($this->perPage)
                                    ->get()->shuffle(), 'default']
                };
                $filter = (int) $request->color_id;
            }
        }


    $parsedUrl = parse_url(url()->full());
    parse_str($parsedUrl['query'] ?? '', $prevQuery);

    // dd($output);
           
        return view('front.index', [
            'animals' => $animalsDir[0],
            'sort' => $animalsDir[1],
            'colors' => Color::all(),
            'filter' => $filter,
            's' => $request->s ?? '',
            'allCount' => $allCount ?? 0,
            'perPage' => $this->perPage ?? 0,
            'prevQuery' => $prevQuery,
            'pageNow' => $page ?? 0
        ]);
    }
}