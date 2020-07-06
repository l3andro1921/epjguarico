<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipos_id')->unsigned()->nullable();
            $table->string('status');
            $table->string('nombre_evento');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('descripcion')->nullable();
            $table->string('lugar_evento')->nullable();
            $table->string('pago')->nullable();
            $table->float('monto_pago')->unsigned()->nullable();
            $table->integer('cupos')->nullable();
            $table->integer('confirmados')->nullable();
            $table->bigInteger('id_coordinador')->unsigned()->nullable();
            $table->bigInteger('id_administrador')->unsigned()->nullable();
            $table->bigInteger('id_asesor')->unsigned()->nullable();
            $table->foreign('tipos_id')->references('id')->on('eventos_tipos')->onDelete('set null');
            $table->foreign('id_coordinador')->references('id')->on('datos_personales')->onDelete('set null');
            $table->foreign('id_administrador')->references('id')->on('datos_personales')->onDelete('set null');
            $table->foreign('id_asesor')->references('id')->on('datos_personales')->onDelete('set null');
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
        Schema::dropIfExists('eventos');
    }
}
