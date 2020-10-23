<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticuloCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_compra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_productos');
            $table->unsignedBigInteger('id_compra');

            $table->integer('cantidad');
            $table->decimal('valor_compra');

            $table->timestamps();

            $table->foreign('id_productos')->references('id')->on('productos');
            $table->foreign('id_compra')->references('id')->on('compra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo_compra');
    }
}
