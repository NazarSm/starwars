<?php

namespace App\Observers;

use App\Models\Character;
use App\Repositories\CharactersRepository;

class CharacterObserver
{
    protected $characterRepository;

    public function __construct()
    {
        $this->characterRepository = app( CharactersRepository::class);
    }

    public function deleting(Character $character)
    {
        $this->characterRepository->getEdit($character->id)->films()->detach();
    }

}
