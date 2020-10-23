<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_documento');
            $table->unsignedBigInteger('id_municipio');
            // $table->unsignedBigInteger('Id_Doc_Fir');
            $table->string('name');
            $table->string('apellido');
            $table->integer('numero_documento');
            $table->text('direccion');            
            $table->string('telefono')->nullable();            
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto')->nullable();
            $table->string('copia_documento')->nullable();
            $table->string('password');
            $table->rememberToken()->unique();
            $table->tinyInteger('activo');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamps();

            $table->foreign('id_tipo_documento')->references('id')->on('tipo_documento');
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
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Schema::dropIfExists('usuarios');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
