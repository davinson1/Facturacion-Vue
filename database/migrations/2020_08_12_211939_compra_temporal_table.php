<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompraTemporalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_temporal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token_usuario');
            $table->string('foto');
            $table->string('id_producto');
            $table->string('nombre_producto');
            $table->string('cantidad_producto');
            $table->string('precio_compra');
            $table->string('precio_venta');
            $table->string('codigo_barras');
            $table->string('descripcion_producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_temporal');
    }
}
