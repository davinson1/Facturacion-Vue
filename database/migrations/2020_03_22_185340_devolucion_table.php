<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DevolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_articulo');
            $table->integer('id_factura');
            $table->integer('id_persona_act');
            $table->timestamp('fecha_devolucion')->useCurrent();
            $table->integer('cantidad');
            $table->integer('valor_total');
            $table->tinyInteger('estado_bueno');
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
        Schema::dropIfExists('devolucion');
    }
}
