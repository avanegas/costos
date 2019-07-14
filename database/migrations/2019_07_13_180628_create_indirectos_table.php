<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndirectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indirectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proyecto_id');
            $table->string('arriendo');
            $table->string('seguros');
            $table->string('financiamiento');
            $table->string('total_indirectos');
            $table->string('utilidades');
            $table->string('otros');
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
        Schema::dropIfExists('indirectos');
    }
}
