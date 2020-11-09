<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Film;
use App\Models\Homeworld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::orderby('updated_at', 'DESC')->with(['homeworld:id,name'])->with(['film:id,movieTitle'])->paginate(4);

        return view('characters', compact('characters'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $homeworlds = Homeworld::all();
        $films = Film::all();

        return view('editCharacter', compact('homeworlds', 'films'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        (new Character())->create($request->input());

        return redirect()->route('character.index')->with('success', 'Data saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        $homeworlds = Homeworld::all();
        $films = Film::all();

        return view('editCharacter', compact('homeworlds', 'films', 'character'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        Character::find($character->id)->fill($request->input())->save();

        return redirect()->route('character.index')->with('success', 'Data update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        Character::find($character->id)->forceDelete();

        return redirect()->route('character.index')->with('success', 'Data delete');

    }
}
