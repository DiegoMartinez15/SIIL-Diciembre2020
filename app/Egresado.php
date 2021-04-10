<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    protected $table = "egresados";
    protected $fillable=['id_alumno',
    'formulario_perfil',
    'seguimieno1',
    'seguimieno2',
    'seguimieno3',
    'seguimieno4',
    'seguimieno_completado',
    ];
    public function perfil(){
        return $this->hasMany('App/FormularioPerfiles');
    }
}
