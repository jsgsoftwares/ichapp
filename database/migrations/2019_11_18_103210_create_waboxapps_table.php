<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaboxappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* $statement = "ALTER TABLE waboxapps AUTO_INCREMENT = 99;";
        DB::unprepared($statement);
         */
        Schema::create('waboxapps', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('user');
            $table->text('mensaje');
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
        Schema::dropIfExists('waboxapps');
    }
}
