<?php

namespace Database\Seeders;

use App\Api\StarwarsApi;
use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{

    public $starwarsData;

    public function __construct(StarwarsApi $starwarsApi)
    {
        $this->starwarsData = $starwarsApi;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $characters = $this->starwarsData->getCharacters();

        foreach ($characters as $character){
            $isCharacter = Character::firstWhere(['name' => $character['name'] ]);

            if(!$isCharacter){
                $newCharacter  = (new Character())->create([
                        // 'id' => $character['id'],
                        'homeworld_id' => $character['homeworld_id'],
                        'name' => $character['name'],
                        'height' => $character['height'],
                        'gender' => $character['gender']
                ]);
                $newCharacter->films()->attach($character['film_id']);
            }
        }
    }
}
