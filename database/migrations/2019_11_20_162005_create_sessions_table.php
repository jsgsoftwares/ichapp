<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('num_sesion');
            $table->bigInteger('idkey');
            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_id');
            $table->foreign('to_id')->references('id')->on('users');
            $table->Integer('flujo_id');
           // $table->foreign('flujo_id')->references('id')->on('flujos');
            $table->unsignedInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->string('mytoken');

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
        Schema::dropIfExists('sessions');
    }
}
