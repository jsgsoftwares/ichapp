<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            //user
            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users');
            //contact
            $table->unsignedBigInteger('to_id');
            $table->foreign('to_id')->references('id')->on('users');
            //message
            $table->text('content');
            $table->text('tipo');
            $table->BigInteger('session_id')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
