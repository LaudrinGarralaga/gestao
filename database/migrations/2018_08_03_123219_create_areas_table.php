<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 200);
            $table->string('sigla', 20);
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });


        Schema::table('areas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('areas');
    }

}
