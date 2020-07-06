<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned();
            $table->string('cedula')->unique();
            $table->string('nombre_completo');
            $table->date('fecha_nac');
            $table->string('telefono');
            $table->string('lugar_nac');
            $table->string('estudio');
            $table->string('nombre_estudio')->nullable();
            $table->string('trabajo');
            $table->string('nombre_trabajo')->nullable();
            $table->string('cargo_trabajo')->nullable();
            $table->string('pasatiempo')->nullable();
            $table->string('bautizo');
            $table->string('comunion');
            $table->string('confirmacion');
            $table->string('parroquia');
            $table->string('arquidiosesis')->nullable();
            $table->string('grupo');
            $table->string('nombre_grupo')->nullable();
            $table->string('tiempo_grupo')->nullable();
            $table->string('practica_grupo')->nullable();
            $table->string('motivo_registro')->nullable();
            $table->string('referencia')->nullable();
            $table->string('sexo');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('datos_personales');
    }
}
