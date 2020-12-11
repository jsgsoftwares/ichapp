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
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->dateTime('started_at');
            $table->date('finish_at')->nullable();
            $table->integer('migrate')->default(0);
            $table->dateTime('migrate_at')->nullable();
            $table->string('subscription_id')->nullable();
            $table->dateTime('renewal_cancelled_at')->nullable();
           

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
