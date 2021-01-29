<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicadasOfertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicadas_ofertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado',1);
            $table->integer('idaspirantes')->unsigned();
            $table->foreign('idaspirantes')->references('id')->on('aspirantes');
            $table->integer('idoferta')->unsigned();
            $table->foreign('idoferta')->references('id')->on('oferta');

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
        Schema::dropIfExists('aplicadas_ofertas');
    }
}
