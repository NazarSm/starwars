<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CharacterFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('сharacter_film', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('character_id')->unsigned();
            $table->bigInteger('film_id')->unsigned();
            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('film_id')->references('id')->on('films');

           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('сharacter_film');

    }
}
