<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('chat_id',100)->nullable();
            $table->unsignedInteger('canal_id');
            $table->foreign('canal_id')->references('id')->on('canales');
            $table->unsignedInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('rols');
            $table->unsignedInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('enabled')->default('1');
            $table->integer('creator')->default('0');
            $table->unsignedInteger('companie_id');
            $table->foreign('companie_id')->references('id')->on('companies');
            $table->integer('inmessage')->default('0');
            $table->integer('configurado')->default('0');
            $table->string('facebook_id',100)->nullable();
            $table->string('twitter_id',100)->nullable();
            $table->string('google_id',100)->nullable();
            $table->string('github_id',100)->nullable();
            $table->string('avatar',100)->nullable();
            $table->string('nick',100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
