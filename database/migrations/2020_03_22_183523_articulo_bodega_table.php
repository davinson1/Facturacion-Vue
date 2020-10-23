<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticuloBodegaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_bodega', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_productos');
            $table->unsignedBigInteger('id_bodega');

            $table->timestamp('fecha_ingreso')->useCurrent();
            $table->date('fecha_vencimiento');
            $table->integer('cantidad');
            
            $table->timestamps();

            $table->foreign('id_productos')->references('id')->on('productos');
            $table->foreign('id_bodega')->references('id')->on('bodega');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo_bodega');
    }
}
