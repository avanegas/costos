<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecioEquiposTable extends Migration
{
    public function up()
    {
        Schema::create('precio_equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('precio_id')->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->string('name');
            $table->string('tarifa');
            $table->decimal('cantidad');
            $table->decimal('rendimiento');
            $table->decimal('total');

            //relation
            $table->foreign('precio_id')->references('id')->on('precios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('equipo_id')->references('id')->on('equipos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('precio_equipos');
    }
}
