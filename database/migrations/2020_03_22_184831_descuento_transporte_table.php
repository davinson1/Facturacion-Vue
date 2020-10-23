<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DescuentoTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuento_transporte', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_aut');
            $table->integer('id_envio');
            $table->integer('id_rec');

            $table->timestamp('fecha_envio')->useCurrent();
            $table->tinyInteger('buen_estado');
            $table->text('descripcion');
            $table->string('scanner');
            
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
        Schema::dropIfExists('descuento_transporte');
    }
}
