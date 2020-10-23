<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoricoPreciosProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos_precios_productos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('id_producto');
            $table->decimal('valor_venta');
            $table->decimal('valor_compra');

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
        Schema::dropIfExists('historicos_precios_productos');
    }
}
