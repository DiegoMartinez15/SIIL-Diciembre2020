<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SegundosIdiomas extends Model
{
    protected $table = "segundos_idiomas";
    protected $fillable=['nombre'];

    public function perfil(){
        return $this->hasMany('App/FormularioPerfiles');
    }
}
