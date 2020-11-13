<?php


namespace App\Api;


use Illuminate\Support\Facades\Http;

class StarwarsApi
{
    const URL = 'https://swapi.dev/api';

    public function getFilms()
    {
        $path = 'films/';
        $films = $this->getAllPage($path);

        foreach ($films as $film) {
            $filmsTitle[] = [
                'movieTitle' => $film['title']
            ];
        }

        return $filmsTitle;
    }

    public function getHomeworlds()
    {
        $path = 'planets/';
        $homeworlds = $this->getAllPage($path);

        foreach ($homeworlds as $homeworld) {
            $homeworldsName[] = [
                'name' => $homeworld['name']
            ];
        }

        return $homeworldsName;
    }

    public function getCharacters()
    {
        $path = 'people/';
        $characters = $this->getAllPage($path);

        foreach ($characters as $character) {
            $films = $character['films'];
            $filmsId = [];

            foreach ($films as $film){
                $filmsId[] = filter_var($film, FILTER_SANITIZE_NUMBER_INT);
            }

            $infoCharacters[] = [
                'homeworld_id' => filter_var($character['homeworld'], FILTER_SANITIZE_NUMBER_INT),
                'film_id' => $filmsId,
                'name' => $character['name'],
                'height' => $character['height'],
                'gender' => $character['gender'],
            ];
        }

        return $infoCharacters;
    }

    public function getAllPage($path)
    {
        $url = sprintf('%s/%s', self::URL, $path);
        $page = Http::get($url);
        $allData = $page['results'];

        while ($page['next'] != null){
            $page =  Http::get($page['next']);
            $allData = array_merge($allData, $page['results']);
        }

        return $allData;
    }

}
