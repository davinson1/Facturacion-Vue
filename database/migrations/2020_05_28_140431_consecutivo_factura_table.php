<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsecutivoFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consecutivo_factura', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_factura');
            $table->unsignedBigInteger('id_tipo_factura');

            $table->bigInteger('consecutivo');
            
            $table->timestamps();

            $table->foreign('id_factura')->references('id')->on('factura');
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
        Schema::dropIfExists('consecutivo_factura_table');
    }
}
