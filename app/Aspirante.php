<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    protected $table = "aspirantes";
    protected $fillable=['codigo','nombre','apellido','articulado','telefono','nota1','nota2','aprobado','fecha_registro','password','tipo_ingreso','idcarrera','idbeca'];

    public function aspirantes(){
        return $this->hasMany('App/TipoUsuario');
    }
    public function perfil(){
        return $this->hasMany('App/FormularioPerfiles');
    }
}
