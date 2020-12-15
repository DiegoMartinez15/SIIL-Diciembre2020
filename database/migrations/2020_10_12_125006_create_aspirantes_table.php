<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAspirantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo',10);
            $table->string('nombres',80);
            $table->string('apellidos',80);
            $table->string('articulado',20);
            $table->string('telefono',9);
            $table->string('nota1',10);
            $table->string('nota2',10);
            $table->string('aprobado',1);
            $table->string('fecha_registro',10);
            $table->string('password',100);
            $table->string('tipo_ingreso',5);
            $table->integer('idcarrera')->unsigned();
            $table->foreign('idcarrera')->references('id')->on('carreras');
            $table->integer('idbeca')->unsigned();
            $table->foreign('idbeca')->references('id')->on('becas');
            $table->integer('idusers')->unsigned()->nullable();
            $table->foreign('idusers')->references('id')->on('users');
            
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
        Schema::dropIfExists('aspirantes');
    }
}
