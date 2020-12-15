<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idaspirante')->unsigned();
            $table->foreign('idaspirante')->references('id')->on('aspirantes');
            $table->integer('idegresado')->unsigned();
            $table->foreign('idegresado')->references('id')->on('egresados');
            $table->string('fecha_nac',50);
            $table->string('foto',50);
            $table->string('correo',100);
            $table->string('genero',25);
            $table->string('direccion',100);
            $table->string('celular',9);
            $table->string('celular2',9);
            $table->string('telefono',9);
            $table->string('dui',9);
            $table->string('red_social',20);
            $table->string('usuario_rs',25);
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('usuarios');
            $table->integer('idcarrera')->unsigned();
            $table->foreign('idcarrera')->references('id')->on('carreras');
            $table->integer('idcarrera2')->unsigned();
            $table->foreign('idcarrera2')->references('id')->on('carreras');
            $table->string('nombre_padre',100);
            $table->string('telefono_padre',9);
            $table->string('nombre_madre',100);
            $table->string('telefono_madre',9);
            $table->string('nombre_enc',100);
            $table->string('parentesco_enc',15);
            $table->string('telefono_enc',9);
            $table->string('integrates_familia',15);
            $table->string('integrates_trabajan',2);
            $table->string('voluntario',10);
            $table->string('grupo_voluntario',25);
            $table->string('enfermadad',35);
            $table->string('medicamento',100);
            $table->string('medio',25);
            $table->string('aceptacion',10);
            $table->string('observaciones',5);
            
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
        Schema::dropIfExists('egresados');
    }
}
