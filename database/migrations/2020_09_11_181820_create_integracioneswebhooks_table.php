<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegracioneswebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integracioneswebhooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->nullable();
            $table->integer('enabled');
            $table->integer('start');
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
            $table->string('phone')->nullable();
            $table->string('pais_id')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('canal');
            $table->string('verify')->nullable();
            $table->string('mytoken');
            $table->integer('createBy');
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
        Schema::dropIfExists('integracioneswebhooks');
    }
}
