<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbonoCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('abono_compra', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('id_compra');
        $table->unsignedBigInteger('interes');

        $table->integer('numero_cuota');
        $table->integer('total_cuota');
        $table->date('fecha_programada');
        $table->date('fecha_compromiso');
        $table->date('fecha_pago');
        $table->integer('valor');
        $table->integer('valor_pago');
        $table->text('descripcion_no_pago');
        $table->tinyInteger('pagado');

        $table->timestamps();
        $table->foreign('id_compra')->references('id')->on('compra');
        $table->foreign('interes')->references('id')->on('porcentaje');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonos_compra');
    }
}
