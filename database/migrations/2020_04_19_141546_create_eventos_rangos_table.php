<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_rangos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipos_id')->unsigned();
            $table->bigInteger('miembros_tipos_id')->unsigned();
            $table->foreign('tipos_id')->references('id')->on('eventos_tipos')->onDelete('cascade');
            $table->foreign('miembros_tipos_id')->references('id')->on('miembros_tipos')->onDelete('cascade');
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
        Schema::dropIfExists('eventos_rangos');
    }
}
