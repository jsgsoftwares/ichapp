<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosclientesModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datosclientes_modulos', function (Blueprint $table) {
            $table->increments('id');
     /*        $table->string('nombre');
            $table->string('placa');
            $table->string('session'); */
/*             $table->string('repuesto');
            $table->string('id_repuesto');
            $table->string('cantidad');
            $table->string('session');
            $table->string('activo'); */
/*             $table->string('placa');
            $table->string('auto_id');
            $table->string('marca');
            $table->string('modelo');
            $table->string('anio'); */
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
        Schema::dropIfExists('datosclientes_modulos');
    }
}
