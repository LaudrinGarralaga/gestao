<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFluxoatividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fluxoatividades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('equipe_id');
            $table->unsignedInteger('fluxo_id');
            $table->integer('precedencia');
            $table->boolean('finalizado');
        });

        Schema::table('fluxoatividades', function (Blueprint $table) {
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');
            $table->foreign('fluxo_id')->references('id')->on('fluxos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fluxoatividades');
    }
}
