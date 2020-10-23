<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('id_factura');

          $table->integer('interes');
          $table->integer('numero_cuotas');
          $table->integer('total_cuotas');
          $table->date('fecha_programacion');
          $table->date('fecha_compromete');
          $table->date('fecha_pago');
          $table->integer('valor');
          $table->integer('valor_pago');
          $table->text('descripcion_no_pago');
          $table->tinyInteger('pagado');
          
          $table->timestamps();

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
        Schema::dropIfExists('abonos');
    }
}
