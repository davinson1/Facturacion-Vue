<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatosEmpresaFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_empresa_factura', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->text('nit');
            $table->text('regimen');
            $table->text('resolucion_dian')->nullable();
            $table->text('representacion_legal');
            $table->text('direccion');
            $table->text('telefono')->nullable();
            $table->text('ciudad');
            $table->text('ofrece')->nullable();
            $table->text('eslogan')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('datos_empresa_factura');
    }
}
