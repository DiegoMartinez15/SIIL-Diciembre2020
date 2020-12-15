<?php

namespace App\Http\Controllers;

use App\FormularioPerfiles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormularioPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function create(Request $request)
    {
        $perfil = new FormularioPerfiles();
        $perfil->idaspirante = $request->idaspirante;
        $perfil->idegresado = $request->idegresado;
        $perfil->lugar_nac = $request->lugar_nac;
        $perfil->celular2 = $request->celular2;
        $perfil->idestado_civil = $request->idestado_civil;
        $perfil->nit = $request->nit;
        $perfil->pasaporte = $request->pasaporte;
        $perfil->licencia_conducir = $request->licencia_conducir;
        $perfil->nup = $request->nup;
        $perfil->idsegundo_idioma = $request->idsegundo_idioma;
        $perfil->nivel_idioma = $request->nivel_idioma;
        $perfil->nacionalidad = $request->nacionalidad;
        $perfil->idenfermedad_cronica = $request->idenfermedad_cronica;
        $perfil->enfermadad_mencion = $request->enfermadad_mencion;
        $perfil->medicamento_perma = $request->medicamento_perma;
        $perfil->medicamento_mencion = $request->medicamento_mencion;
        $perfil->discapacidad = $request->discapacidad;
        $perfil->nivel_academico = $request->nivel_academico;
        $perfil->institucion_formadora = $request->institucion_formadora;
        $perfil->anio_graduacion = $request->anio_graduacion;
        $perfil->practica_pro = $request->practica_pro;
        $perfil->cursos_informacion = $request->cursos_informacion;
        $perfil->oficios_realizar = $request->oficios_realizar;
        $perfil->formacion_emprende = $request->formacion_emprende;
        $perfil->idea_negocio = $request->idea_negocio;
        $perfil->instituto_formador_emprede = $request->instituto_formador_emprede;
        $perfil->anio_formacion = $request->anio_formacion;
        $perfil->experiencia_laboral = $request->experecia_laboral;
        $perfil->ultimo_periodo_trabajo = $request->ultimo_periodo_trabajo;
        $perfil->cargo_desempenado = $request->cargo_desempenado;
        $perfil->habilidades_personales = $request->habilidades_personales;
        $perfil->dificultades_personales = $request->dificultades_personales;
        $perfil->asistencia = $request->asistencia;
        $perfil->puntualidad = $request->puntualidad;
        $perfil->responsabilidad = $request->responsabilidad;
        $perfil->disponibilidad_horaria = $request->disponibilidad_horaria;
        $perfil->recomendacion_derivacion = $request->recomendacion_derivacion;
        $perfil->otra_observacion = $request->otra_observacion;
        $perfil->save();
       
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perfil = new FormularioPerfiles();
        $perfil->id_aspirante = $request->id_aspirante;
        $perfil->id_egresado = $request->id_egresado;
        $perfil->id_carrera = $request->id_carrera;
        $perfil->lugar_nac = $request->lugar_nac;
        $perfil->celular2 = $request->celular2;
        $perfil->estado_civil = $request->estado_civil;
        $perfil->nit = $request->nit;
        $perfil->pasaporte = $request->pasaporte;
        $perfil->licencia_conducir = $request->licencia_conducir;
        $perfil->nup = $request->nup;
        $perfil->idsegundo_idioma = $request->idsegundo_idioma;
        $perfil->nivel_idioma = $request->nivel_idioma;
        $perfil->nacionalidad = $request->nacionalidad;
        $perfil->enfermedad_cronica = $request->enfermedad_cronica;
        $perfil->enfermadad_mencion = $request->enfermadad_mencion;
        $perfil->medicamento_perma = $request->medicamento_perma;
        $perfil->medicamento_mencion = $request->medicamento_mencion;
        $perfil->discapacidad = $request->discapacidad;
        $perfil->nivel_academico = $request->nivel_academico;
        $perfil->institucion_formadora = $request->institucion_formadora;
        $perfil->id_anio_graduacion = $request->id_anio_graduacion;
        $perfil->cursos_informacion = $request->cursos_informacion;
        $perfil->oficios_realizar = $request->oficios_realizar;
        $perfil->formacion_emprende = $request->formacion_emprende;
        $perfil->idea_negocio = $request->idea_negocio;
        $perfil->instituto_formador_emprede = $request->instituto_formador_emprede;
        $perfil->anio_formacion = $request->anio_formacion;
        $perfil->experiencia_laboral = $request->experecia_laboral;
        $perfil->ultimo_periodo_trabajo = $request->ultimo_periodo_trabajo;
        $perfil->cargo_desempenado = $request->cargo_desempenado;
        $perfil->habilidades_personales = $request->habilidades_personales;
        $perfil->dificultades_personales = $request->dificultades_personales;
        $perfil->disponibilidad_horaria = $request->disponibilidad_horaria;
        $perfil->recomendacion_derivacion = $request->recomendacion_derivacion;
        $perfil->otra_observacion = $request->otra_observacion;
        $perfil->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
