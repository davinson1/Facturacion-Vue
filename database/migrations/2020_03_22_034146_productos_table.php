<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_articulo');
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_porcentaje');

            $table->text('nombre');
            $table->decimal('valor_venta')->nullable()->default(0);
            $table->integer('porcentaje_minimo')->nullable()->default(0);
            $table->integer('cantidad')->nullable()->default(0);
            $table->text('codigo_barras')->nullable();
            $table->string('foto')->nullable();
            $table->text('descripcion')->nullable();

            $table->timestamps();

            $table->foreign('id_tipo_articulo')->references('id')->on('tipo_articulo');
            $table->foreign('id_proveedor')->references('id')->on('proveedor');
            $table->foreign('id_categoria')->references('id')->on('categoria_productos');
            $table->foreign('id_porcentaje')->references('id')->on('porcentaje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
