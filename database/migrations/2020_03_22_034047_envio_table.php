<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_persona_transporte');
            $table->unsignedBigInteger('id_factura');

            $table->tinyInteger('entregado');
            $table->date('fecha_envio');
            $table->date('fecha_producto');
            $table->text('direccion');
            $table->timestamps();

            $table->foreign('id_persona_transporte')->references('id')->on('users');
            $table->foreign('id_factura')->references('id')->on('factura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envio');
    }
}
