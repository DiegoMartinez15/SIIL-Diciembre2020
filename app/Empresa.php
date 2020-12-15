<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresas";
    protected $fillable=['nombre','direccion','telefono','encargado','idarea','idusuario'];

    public function usuarios(){
        return $this->hasMany('App/Usuario');
    }
}
