<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pais');
            $table->text('nombre');
            $table->timestamps();

            $table->foreign('id_pais')->references('id')->on('pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('departamento');
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
