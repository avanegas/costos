<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObrerosTable extends Migration
{
    public function up()
    {
        Schema::create('obreros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_obrero_id')->unsigned();
            $table->string('name')->unique();
            $table->string('jornalhora');
            $table->string('factor');

            //relation
            $table->foreign('grupo_obrero_id')->references('id')->on('grupo_obreros')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('obreros');
    }
}
