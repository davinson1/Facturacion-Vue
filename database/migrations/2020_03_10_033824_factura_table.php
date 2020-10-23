<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('id_iva');
          $table->unsignedBigInteger('id_forma_pago');
          $table->unsignedBigInteger('id_tipo_factura');

          $table->integer('codigo_factura');
          $table->timestamp('fecha_creacion')->useCurrent();
          $table->date('fecha_anulacion');
          $table->tinyInteger('anulado');
          $table->tinyInteger('devolucion_producto');
          $table->date('fecha_devolucion');
          $table->integer('valor_envio');
          $table->integer('valor_iva');
          $table->integer('valor_devolucion');
          $table->integer('valor_total');
          $table->tinyInteger('iva');

          $table->timestamps();

          $table->foreign('id_iva')->references('id')->on('iva');
          $table->foreign('id_forma_pago')->references('id')->on('forma_pago');
          $table->foreign('id_tipo_factura')->references('id')->on('tipo_factura');
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
             Schema::dropIfExists('factura');
             DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
