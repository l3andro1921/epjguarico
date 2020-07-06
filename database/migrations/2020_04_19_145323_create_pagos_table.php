<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eventos_id')->unsigned();
            $table->bigInteger('datos_id')->unsigned();
            $table->string('tipo_pago');
            $table->string('banco');
            $table->string('referencia');
            $table->float('monto')->unsigned();
            $table->date('fecha');
            $table->string('status');
            $table->foreign('eventos_id')->references('id')->on('eventos')->onDelete('cascade');
            $table->foreign('datos_id')->references('id')->on('datos_personales')->onDelete('cascade');
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
        Schema::dropIfExists('pagos');
    }
}
