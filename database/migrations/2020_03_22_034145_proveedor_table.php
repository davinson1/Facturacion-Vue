<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_usuario_modifica')->nullable();

            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('descripcion')->nullable();
            $table->tinyInteger('estado')->default('1');

            $table->timestamps();

            $table->foreign('id_empresa')->references('id')->on('empresa');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_usuario_modifica')->references('id')->on('users');
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
        Schema::dropIfExists('proveedor');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
