<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('etapas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procedencia');
            $table->unsignedInteger('area_id');
            $table->unsignedInteger('fluxo_id');
        });

        Schema::table('etapas', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('fluxo_id')->references('id')->on('fluxos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('etapas');
    }

}
