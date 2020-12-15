<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios_seguimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idaspirante')->unsigned();
            $table->foreign('idaspirante')->references('id')->on('aspirantes');
            $table->integer('idegresado')->unsigned();
            $table->foreign('idegresado')->references('id')->on('egresados');
            $table->integer('idmunicipio')->unsigned();
            $table->foreign('idmunicipio')->references('id')->on('municipios');
            $table->string('continua_estudiando',2);
            $table->string('empleado',10);
            $table->string('empleado_area_trabajo',75);
            $table->string('interes_colocado',2);
            $table->string('tipo_empleo',10);
            $table->string('nombre_empresa',100);
            $table->string('contacto_empresa',75);
            $table->string('cargo_desempenia',50);
            $table->string('tel_empresa',9);
            $table->string('estatus',10);
            $table->string('fecha_monitoreo',50);
            
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
        Schema::dropIfExists('formularios_seguimientos');
    }
}
