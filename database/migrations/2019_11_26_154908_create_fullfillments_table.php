<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullfillmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullfillments', function (Blueprint $table) {
            $table->increments('id');
            //FLUJO DE OPERACION
            $table->unsignedInteger('flujo_id');
            $table->foreign('flujo_id')->references('id')->on('flujos');
            //INTENT
            $table->string('intentId');
            //FLUJO DE OPERACION
            $table->unsignedInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
           
            
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
        Schema::dropIfExists('fullfillments');
    }
}
