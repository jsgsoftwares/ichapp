<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccionesModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acciones_modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intento');
            $table->integer('num');
            $table->string('accion');
            $table->string('execute');
            $table->integer('true');
            $table->integer('false');
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
        Schema::dropIfExists('acciones_modulos');
    }
}
