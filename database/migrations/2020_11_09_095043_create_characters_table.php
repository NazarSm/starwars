<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('homeworld_id')->unsigned();
            $table->bigInteger('film_id')->unsigned();

            $table->text('name');
            $table->bigInteger('height');
            $table->enum('gender', ['male', 'female', 'n/a']);

            $table->foreign('homeworld_id')->references('id')->on('homeworlds');
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
        Schema::dropIfExists('characters');
    }
}