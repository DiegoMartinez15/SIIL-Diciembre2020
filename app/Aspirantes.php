<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirantes extends Model
{
    protected $table = "aspirantes";
    protected $fillable=['codigo',
        'nombres',
        'apellidos',
        'articulado',
        'telefono',
        'nota1',
        'nota2',
        'aprobado',
        'fecha_registro',
        'password',
        'tipo_ingreso',
        'idcarrera',
        'idbeca'
        ];
}
