<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioSeguimiento extends Model
{
    protected $table = "formularios_seguimientos";
    protected $fillable=['id_aspirante',
    'id_egresado',
    'id_municipio',
    'continua_estudianso',
    'empleado',
    'empleado_area_trabajo',
    'tipo_empleo',
    'contacto_empresa',
    'cargo_desempena',
    'tel_empresa',
    'estatus',
    'fecha_monitorio'
];
}
