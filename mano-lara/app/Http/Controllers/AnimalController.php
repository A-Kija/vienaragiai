<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $colors = Color::all()->sortByDesc('title');
        // $colors = Color::where('id', '<', 100)->orderBy('title')->get();

        // $colors = match($request->sort) {
        //     'asc' => Color::orderBy('title', 'asc')->get(),
        //     'desc' => Color::orderBy('title', 'desc')->get(),
        //     default => Color::all()
        // };

        $animals = Animal::all();
           
        return view('animal.index', ['animals' => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        
        return view('animal.create', ['colors' => $colors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animal = new Animal;

        $animal->name = $request->animal_name;

        $animal->color_id = $request->color_id;

        $animal->save();

        return redirect()->route('animals-index')->with('success', 'You are the best!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(int $animalId)
    {
        $animal = Animal::where('id', $animalId)->first();
        
        return view('animal.show', ['animal' => $animal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        
        $colors = Color::all();
        
        return view('animal.edit', [
            'animal' => $animal,
            'colors' => $colors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $animal->name = $request->animal_name;

        $animal->color_id = $request->color_id;

        $animal->save();

        return redirect()->route('animals-index')->with('success', 'You are the best!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('animals-index')->with('deleted', 'Animal is dead :(');
    }
}
