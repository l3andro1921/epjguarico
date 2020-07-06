<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miembros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('datos_id')->unsigned();
            $table->date('fecha');
            $table->bigInteger('tipos_id')->unsigned()->nullable();
            $table->bigInteger('comunidades_id')->unsigned()->nullable();
            $table->foreign('datos_id')->references('id')->on('datos_personales')->onDelete('cascade');
            $table->foreign('tipos_id')->references('id')->on('miembros_tipos')->onDelete('set null');
            $table->foreign('comunidades_id')->references('id')->on('comunidades')->onDelete('set null');
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
        Schema::dropIfExists('miembros');
    }
}
