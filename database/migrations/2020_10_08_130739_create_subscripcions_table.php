<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscripcions', function (Blueprint $table) {
            $table->increments('id');

           /*  $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references()->on('users');

            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references()->on('plans');


            $table->dateTime('started_at');
            $table->dateTime('finish_at');

            $table->boolean('renewal')->default(true);
            $table->dateTime('renewal_cancelled_at');


            $table->dateTime('ended_at'); */
            

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
        Schema::dropIfExists('subscripcions');
    }
}
