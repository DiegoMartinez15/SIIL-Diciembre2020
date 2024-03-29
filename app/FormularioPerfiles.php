<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioPerfiles extends Model
{
    protected $table = "formularios_perfiles";
    protected $fillable=[
    'id_egresado',
    'id_carrera',
    'lugar_nac',
    'celular2',
    'estado_civil',
    'nit',
    'pasaporte',
    'licencia_conducir',
    'nup',
    'idsegundo_idioma',
    'nivel_idioma',
    'nacionalidad',
    'enfermedad_cronica',
    'enfermedad_mencion',
    'medicamento_perma',
    'medicamento_mencion',
    'discapacidad',
    'nivel_academico',
    'institucion_formadora',
    'id_anio_graduacion',
    'cursos_informacion',
    'oficios_realizar',
    'formacion_emprende',
    'idea_negocio',
    'instituto_formador_emprede',
    'anio_formacion',
    'experiencia_laboral',
    'ultimo_periodo_trabajo',
    'cargo_desempenado',
    'habilidades_personales',
    'dificultades_personales',
    'disponibilidad_horaria',
    'recomendacion_derivacion',
    'traslado_fuera',
    'otra_observacion',
];

    public function aspirante(){
        return $this->hasMany('App/Aspirente');
    }

    public function egresado(){
        return $this->hasMany('App/Egresados');
    }

    public function idioma(){
        return $this->hasMany('App/SegundosIdiomas');
    }
}    