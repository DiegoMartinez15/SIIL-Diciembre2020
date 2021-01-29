<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicadas_ofertas extends Model
{
    protected $table = "aplicadas_ofertas";
    protected $fillable=['estado','idaspirantes','idoferta'];

    public function aspirantes(){
        return $this->belongsToMany('App/Aspirante');
    }

    public function oferta(){
        return $this->belongsToMany('App/Oferta');
    }
}
