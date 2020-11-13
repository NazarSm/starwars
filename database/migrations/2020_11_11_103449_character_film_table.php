<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CharacterFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_film', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('character_id')->unsigned();
            $table->bigInteger('film_id')->unsigned();

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('film_id')->references('id')->on('films');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_film');

    }
}
