<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');            
            $table->string('estado',1);
            $table->integer('idform_accept')->nullable()->unsigned();
            $table->foreign('idform_accept')->references('id')->on('form_accept');
            $table->integer('idtipo_usuario')->unsigned();
            $table->foreign('idtipo_usuario')->references('id')->on('tipos_usuarios');
            $table->integer('idaspirante')->unsigned()->unique();
            $table->foreign('idaspirante')->references('id')->on('aspirantes');
            $table->integer('idusuario')->unsigned()->unique();
            $table->foreign('idusuario')->references('id')->on('usuarios');
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
