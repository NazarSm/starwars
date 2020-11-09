<?php


namespace App\Api;


use Illuminate\Support\Facades\Http;

class StarwarsApi
{
    public $url = 'https://swapi.dev/api/';

    public function getFilms()
    {
        $films = Http::get($this->url . 'films/');
        $films = $films->json();

        foreach ($films['results'] as $item){
            $filmsTitle[] = ['movieTitle' => $item['title']];
        }

        return $filmsTitle;
    }

    public function getHomeworld()
    {
        $homeworlds = Http::get($this->url . 'planets/');
        $homeworlds = $homeworlds->json();

        foreach ($homeworlds['results'] as $item){
            $homeworldsName[] = ['name' => $item['name']];
        }
        return $homeworldsName;

    }
    public function getInfoCharacter()
    {
        $characters = Http::get($this->url . 'people/');
        return $characters->json();
    }
}
