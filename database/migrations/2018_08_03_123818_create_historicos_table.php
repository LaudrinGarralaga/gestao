<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('etapa_id');
        });

        Schema::table('historicos', function (Blueprint $table) {
            $table->foreign('etapa_id')->references('id')->on('etapas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('historicos');
    }

}
