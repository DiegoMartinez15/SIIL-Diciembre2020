<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";
    protected $fillable=['nombre','passwd'];

    public function empresas(){
        return $this->hasMany('App/Empresa');
    }
}
