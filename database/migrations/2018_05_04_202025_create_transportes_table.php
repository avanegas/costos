<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportesTable extends Migration
{
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zona_id')->unsigned();
            $table->string('name')->unique();
            $table->string('unidad');
            $table->string('tipo');
            $table->string('tarifa');

            //relation
            $table->foreign('zona_id')->references('id')->on('zonas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transportes');
    }
}
