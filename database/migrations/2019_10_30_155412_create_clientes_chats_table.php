<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_chats', function (Blueprint $table) {
            $table->increments('id');
/*             $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); */
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('tipo_nip_id');
            $table->string('nip');
            $table->unsignedInteger('pais_id');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->unsignedInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->string('profesion',200);
            $table->date('nacimiento');
            $table->string('correo',200);
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
        Schema::dropIfExists('clientes_chats');
    }
}
