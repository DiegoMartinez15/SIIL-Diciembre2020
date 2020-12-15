<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egresados extends Model
{
    protected $table = "egresados";
    protected $fillable=['id_aspirante',
    'fecha_nacimiento',
    'foto',
    'correo',
    'genero',
    'direccion',
    'celular',
    'telefono',
    'dui',
    'red_social',
    'usuario_rs',
    'id_usuario',
    'id_municipio',
    'vivienda_propia',
    'id_instituto',
    'anio_bache',
    'id_bachierato',
    'id_carrera',
    'id_carrera2',
    'nombre_padre',
    'telefono_padre',
    'nombre_madre',
    'telefono_madre',
    'nombre_enc',
    'parentesco_enc',
    'telefono_enc',
    'integrantes_familia',
    'integrantes_trabajan',
    'voluntario',
    'grupo_voluntario',
    'enfermadad',
    'medicamento',
    'medio',
    'aceptacion',
    'observaciones'
    ];
    public function perfil(){
        return $this->hasMany('App/FormularioPerfiles');
    }
}
