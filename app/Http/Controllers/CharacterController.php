<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Repositories\CharactersRepository;
use App\Repositories\FilmsRepository;
use App\Repositories\HomeworldsRepository;

class CharacterController extends Controller
{
    protected $characterRepository;
    protected $filmsRepository;
    protected $homeworldRepository;

    public function __construct()
    {
        $this->characterRepository = app( CharactersRepository::class);
        $this->filmsRepository = app( FilmsRepository::class);
        $this->homeworldRepository = app( HomeworldsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = $this->characterRepository->getAllWithPaginate(10);

        return view('characters', compact('characters'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $homeworlds = $this->homeworldRepository->getAll();
        $films = $this->filmsRepository->getAll();

        return view('editCharacter', compact('homeworlds', 'films'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterRequest $characterRequest)
    {
        $newCharacter = $this->characterRepository->createNew()->create($characterRequest->input());
        $newCharacter->films()->attach($characterRequest['film_id']);

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
        $editCharacter = $character;
        $homeworlds = $this->homeworldRepository->getAll();
        $films = $this->filmsRepository->getAll();

        return view('editCharacter', compact('homeworlds', 'films', 'editCharacter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(CharacterRequest $characterRequest, Character $character)
    {

        $this->characterRepository->getEdit($character->id)->fill($characterRequest->input())->save();
        $this->characterRepository->getEdit($character->id)->films()->detach();
        $this->characterRepository->getEdit($character->id)->films()->attach($characterRequest['film_id']);

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
        $this->characterRepository->getEdit($character->id)->films()->detach();
        $this->characterRepository->getEdit($character->id)->forceDelete();

        return redirect()->route('character.index')->with('success', 'Data delete');

    }
}
