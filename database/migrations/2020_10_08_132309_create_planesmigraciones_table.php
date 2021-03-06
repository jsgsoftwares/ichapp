<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesmigracionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planesmigraciones', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
    
            $table->unsignedInteger('from_plan_id');
            $table->foreign('from_plan_id')->references('id')->on('plans');
            
            $table->unsignedInteger('to_plan_id');
            $table->foreign('to_plan_id')->references('id')->on('plans');
           
            $table->dateTime('requested_at')->nullable();
            $table->dateTime('execution_at')->nullable();
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
        Schema::dropIfExists('planesmigraciones');
    }
}
