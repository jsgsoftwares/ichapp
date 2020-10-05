<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegracionbotflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integracionbotflows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->string('filename')->nullable();
            $table->string('project_id')->nullable();
            $table->unsignedInteger('bot_id');
            $table->foreign('bot_id')->references('id')->on('aibots');
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
            $table->integer('enabled');
            $table->integer('start');
            $table->unsignedBigInteger('createBy');
            $table->foreign('createBy')->references('id')->on('users');
            $table->string('mytoken');
            $table->unsignedInteger('canal_id');
            $table->foreign('canal_id')->references('id')->on('canales');
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
        Schema::dropIfExists('integracionbotflows');
    }
}
