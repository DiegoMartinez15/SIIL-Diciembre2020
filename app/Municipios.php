<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = "becas";
    protected $fillable=['nombre','direccion','id_municipio'];
}
