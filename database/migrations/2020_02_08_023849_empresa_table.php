<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_tributario');
            $table->unsignedBigInteger('id_municipio');
            $table->text('nombre');
            $table->integer('numero');
            $table->text('direccion');
            $table->text('telefono');
            $table->text('celular');
            $table->text('descripcion');
            $table->text('nombre_jefe');
            $table->text('celular_jefe');
            $table->tinyInteger('estado')->default('1');
            $table->date('fecha_creacion');
            $table->timestamps();

            $table->foreign('id_tipo_tributario')->references('id')->on('tipo_tributario');
            $table->foreign('id_municipio')->references('id')->on('municipio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
