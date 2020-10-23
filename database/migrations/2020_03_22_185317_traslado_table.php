<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrasladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('traslado', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('id_bodega_sale');
        $table->unsignedBigInteger('id_bodega_entra');
        $table->unsignedBigInteger('id_descuento_transporte');
        
        $table->integer('cantidad');
        $table->timestamp('fecha_traslado')->useCurrent();
        $table->timestamps();

        $table->foreign('id_bodega_sale')->references('id')->on('bodega');
        $table->foreign('id_bodega_entra')->references('id')->on('bodega');
        $table->foreign('id_descuento_transporte')->references('id')->on('descuento_transporte');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traslado');
    }
}
