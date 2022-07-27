<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Validator;

class ColorController extends Controller
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

        $colors = match($request->sort) {
            'asc' => Color::orderBy('title', 'asc')->get(),
            'desc' => Color::orderBy('title', 'desc')->get(),
            default => Color::all()
        };
           
        return view('color.index', ['colors' => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),
        [
            'color_title' => ['required', 'min:3', 'max:64'],
            'create_color_input' => ['required', 'regex:/^\#([0-9A-Fa-f]){6}$/'],
        ],
        [
            'color_title.required' => 'Write something!',
            'color_title.min' => 'You are too short!',
        ]
        );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        
        
        
        
        $color = new Color;

        $color->color = $request->create_color_input;

        $color->title = $request->color_title;

        $color->save();

        return redirect()->route('colors-index')->with('success', 'You are the best!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(int $colorId)
    {
        $color = Color::where('id', $colorId)->first();
        
        return view('color.show', ['color' => $color]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        
        
        return view('color.edit', ['color' => $color]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        
        $validator = Validator::make($request->all(),
        [
            'color_title' => ['required', 'min:3', 'max:64'],
            'create_color_input' => ['required', 'regex:/^\#([0-9A-Fa-f]){6}$/'],
        ],
        [
            'color_title.required' => 'Write something!',
            'color_title.min' => 'You are too short!',
        ]
        );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
        
        
        
        $color->color = $request->create_color_input;

        $color->title = $request->color_title ?? 'no title';

        $color->save();

        return redirect()->route('colors-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        
        if (!$color->animals->count()) {
            $color->delete();
            return redirect()->route('colors-index')->with('deleted', 'Color gone!');
        }
        return redirect()->back()->with('deleted', 'No no, it is imposible!');
       

        
    }

    public function link() 
    {
        abort(403);
    }
}
