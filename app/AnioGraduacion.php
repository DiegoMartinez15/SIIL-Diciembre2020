<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnioGraduacion extends Model
{
    protected $table = "anio_graduacion";
    protected $fillable=['anio'];


    public function perfil(){
        return $this->hasMany('App/FormularioPerfiles');
    }
}
