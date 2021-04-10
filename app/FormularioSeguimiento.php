<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioSeguimiento extends Model
{
    protected $table = "formularios_seguimientos";
    protected $fillable=[
    'id_egresado',
    'continua_estudiando',
    'empleado',
    'interes_colocado',
    'empleado_area_trabajo',
    'tipo_empleo',
    'nombre_empresa',
    'contacto_empresa',
    'cargo_desempenia',
    'tel_empresa',
    'estatus',
    'trimestre',
    'fecha_monitoreo'
];
}
