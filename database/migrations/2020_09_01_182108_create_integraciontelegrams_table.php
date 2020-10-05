<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegraciontelegramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integraciontelegrams', function (Blueprint $table) {
             $table->increments('id');
            /*
            $table->string('token');
            $table->integer('enabled');
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
            $table->string('phone');
            $table->string('canal');
            $table->string('verify');
            $table->string('mytoken');
            $table->integer('createBy'); */
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
        Schema::dropIfExists('integraciontelegrams');
    }
}
