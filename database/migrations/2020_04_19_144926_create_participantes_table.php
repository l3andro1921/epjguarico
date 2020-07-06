<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eventos_id')->unsigned();
            $table->bigInteger('datos_id')->unsigned();
            $table->string('status');
            $table->string('asistencia')->nullable();
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
        Schema::dropIfExists('participantes');
    }
}
