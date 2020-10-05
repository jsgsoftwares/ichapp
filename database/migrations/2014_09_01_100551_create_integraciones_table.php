<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegracionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integraciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('canal_id');
            $table->foreign('canal_id')->references('id')->on('canales');
           
            $table->string('name');
            $table->string('description');
            $table->string('avatar');
            $table->integer('enabled');
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
        Schema::dropIfExists('integraciones');
    }
}
