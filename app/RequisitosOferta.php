<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitosOferta extends Model
{
    protected $table = "requisitos";
    protected $fillable=['edad','genero','nivel_academico','experiencia','horario','comicion',
    'conocimiento','licencia','ambiente','prestaciones','idoferta'];

    public function ofertas(){
        return $this->hasMany('App/Oferta');
    }
}
