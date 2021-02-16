<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Aspirante;
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
    public function index(Request $request) 
    {

        $formulario = FormularioPerfiles::join('anio_graduacion',
       'formularios_perfiles.id_anio_graduacion','=','anio_graduacion.id')->join('carreras','formularios_perfiles.id_carrera','=','carreras.id')->join('aspirantes','formularios_perfiles.id_aspirante','=','aspirantes.id')->join('segundos_idiomas','formularios_perfiles.idsegundo_idioma','=','segundos_idiomas.id')->select('anio_graduacion.anio as id_anio_graduacion','carreras.nombre as id_carrera','aspirantes.nombres as nombres','aspirantes.apellidos as apellidos','formularios_perfiles.estado_civil as estado_civil','formularios_perfiles.pasaporte as pasaporte','formularios_perfiles.celular2 as celular2','formularios_perfiles.licencia_conducir as licencia_conducir','formularios_perfiles.nup as nup','formularios_perfiles.nivel_idioma as nivel_idioma','formularios_perfiles.enfermedad_cronica as enfermedad_cronica','formularios_perfiles.enfermadad_mencion as enfermadad_mencion','formularios_perfiles.medicamento_perma as medicamento_perma','formularios_perfiles.medicamento_mencion','formularios_perfiles.discapacidad as discapacidad','formularios_perfiles.cursos_informacion as cursos_informacion','formularios_perfiles.oficios_realizar as oficios_realizar','formularios_perfiles.idea_negocio as idea_negocio','formularios_perfiles.experiencia_laboral as experecia_laboral','formularios_perfiles.ultimo_periodo_trabajo as ultimo_periodo_trabajo','formularios_perfiles.cargo_desempenado as cargo_desempenado','formularios_perfiles.habilidades_personales as habilidades_personales','formularios_perfiles.dificultades_personales as dificultades_personales','formularios_perfiles.disponibilidad_horaria as disponibilidad_horaria','formularios_perfiles.otra_observacion','segundos_idiomas.nombre as idsegundo_idioma','formularios_perfiles.id as id')->where("id_aspirante","=",$request->id)->get();

        return $formulario;  
        //$formulario = FormularioPerfiles::where("id_aspirante","=",$request->id)->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        try{
            $nit = FormularioPerfiles::where("nit","=",$request->nit)->get();
            $nup = FormularioPerfiles::where("nup","=",$request->nup)->get();
            $pasaporte = FormularioPerfiles::where("pasaporte","=",$request->pasaporte)->get();
            $licencia_conducir = FormularioPerfiles::where("licencia_conducir","=",$request->licencia_conducir)->get();
            $lenNit = sizeof($nit);
            $lenNup = sizeof($nup);
            $lenPas = sizeof($pasaporte);
            $lenLic = sizeof($licencia_conducir);

            /*return response()->json([
                'res' => false,
                
                'len' => $lenNit,
                'len1' => $lenNup,
                'len2' => $lenPas,
                'len3' => $lenLic,
            ],200);*/
            

            //$lenNiit es 0
            if($lenNit == 0){
               if($lenNup == 0){
                    if($lenPas == 0){
                        if($lenLic == 0){
                           
                              /*Codigo de guarda */
                           DB::beginTransaction();
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
               
                           $aspirante =  Aspirante::findOrFail($id= $perfil->id_aspirante);
                           $aspirante->formulario_perfil = 'Si';
                           $aspirante->save();
                           
                        }else{
                            return response()->json([
                                'res' => false,
                                'msg' =>"si viene licencia",
                            ],200);
                        }
                    }else{
                        return response()->json([
                            'res' => false,
                            'msg' =>"si viene pas",
                        ],200);
                    }
               }else{
                    return response()->json([
                        'res' => false,
                        'msg' =>"si viene nup ",
                    ],200);
               }
                
            }else{
                return response()->json([
                'res' => false,
                'msg' =>"si viene nit ",
            ],200);
                
            }
            

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
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
        $perfil = FormularioPerfiles::findOrfail($request->id);
        $perfil->celular2 = $request->celular2;
        $perfil->estado_civil = $request->estado_civil;
        $perfil->pasaporte = $request->pasaporte;
        $perfil->licencia_conducir = $request->licencia_conducir;
        $perfil->nup = $request->nup;
        $perfil->nivel_idioma = $request->nivel_idioma;
        $perfil->enfermedad_cronica = $request->enfermedad_cronica;
        $perfil->enfermadad_mencion = $request->enfermadad_mencion;
        $perfil->medicamento_perma = $request->medicamento_perma;
        $perfil->medicamento_mencion = $request->medicamento_mencion;
        $perfil->discapacidad = $request->discapacidad;
        $perfil->cursos_informacion = $request->cursos_informacion;
        $perfil->oficios_realizar = $request->oficios_realizar;
        $perfil->idea_negocio = $request->idea_negocio;
        $perfil->experiencia_laboral = $request->experecia_laboral;
        $perfil->ultimo_periodo_trabajo = $request->ultimo_periodo_trabajo;
        $perfil->cargo_desempenado = $request->cargo_desempenado;
        $perfil->habilidades_personales = $request->habilidades_personales;
        $perfil->dificultades_personales = $request->dificultades_personales;
        $perfil->disponibilidad_horaria = $request->disponibilidad_horaria;
        $perfil->otra_observacion = $request->otra_observacion;
        $perfil->save();
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
