<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->increments('id');
            //user
            $table->Integer('canal_id');
            //$table->foreign('canal_id')->references('id')->on('canales');
             //id cliente 
            $table->Integer('cliente_id');
           // $table->foreign('cliente_id')->references('id')->on('users');
            $table->text('mensaje');
            $table->text('tipo');
            $table->text('mytoken');
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
        Schema::dropIfExists('webhooks');
    }
}
