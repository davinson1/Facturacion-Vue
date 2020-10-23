<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_departamento');
            $table->text('nombre');
            $table->timestamps();

            $table->foreign('id_departamento')->references('id')->on('departamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('municipio');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
