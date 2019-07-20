<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_equipo_id')->unsigned();
            $table->string('name')->unique();
            $table->string('marca')->nullable();
            $table->string('tipo')->nullable();
            $table->string('tarifa');

            //relation
            $table->foreign('grupo_equipo_id')->references('id')->on('grupo_equipos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
