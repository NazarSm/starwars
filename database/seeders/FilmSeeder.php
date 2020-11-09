<?php

namespace Database\Seeders;

use App\Api\StarwarsApi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
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
      $films = $this->starwarsData->getFilms();
      DB::table('films')->insert($films);

    }
}
