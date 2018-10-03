<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao');
            $table->unsignedInteger('area_id');
            $table->unsignedInteger('responsavel');
        });

        Schema::table('equipes', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('responsavel')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('equipes');
    }

}
