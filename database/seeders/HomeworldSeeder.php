<?php

namespace Database\Seeders;

use App\Api\StarwarsApi;
use App\Models\Homeworld;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeworldSeeder extends Seeder
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
        $homeworlds = $this->starwarsData->getHomeworlds();

        foreach ($homeworlds as $homeworld){
            Homeworld::firstOrCreate($homeworld);
        }
    }
}
