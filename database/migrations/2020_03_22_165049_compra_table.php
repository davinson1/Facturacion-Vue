<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('compra', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('id_tipo_compra');
        $table->unsignedBigInteger('id_usuario');
        $table->unsignedBigInteger('id_forma_pago');
        $table->unsignedBigInteger('id_proveedor');

        $table->string('scanner')->nullable();
        $table->string('total_compra');
        $table->text('descripcion');
        $table->tinyInteger('estato')->default('1');

        $table->timestamps();

        $table->foreign('id_tipo_compra')->references('id')->on('tipo_compra');
        $table->foreign('id_usuario')->references('id')->on('users');
        $table->foreign('id_forma_pago')->references('id')->on('forma_pago');
        $table->foreign('id_proveedor')->references('id')->on('proveedor');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
