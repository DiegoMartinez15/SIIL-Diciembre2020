<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
 
use App\Egresado;
use App\FormularioPerfiles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

class FormularioPerfilController extends Controller
{
    
    public function index(Request $request) 
    { 

        $formulario = FormularioPerfiles::join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('alumnos','alumnos.id_egresado','=','egresados.id')->join('aspirantes','alumnos.idaspirante','=','aspirantes.id')->join('anio_graduacion','formularios_perfiles.id_anio_graduacion','=','anio_graduacion.id')->join('carreras','formularios_perfiles.id_carrera','=','carreras.id')->join('segundos_idiomas','formularios_perfiles.idsegundo_idioma','=','segundos_idiomas.id')->select('anio_graduacion.anio as id_anio_graduacion','carreras.nombre as id_carrera','aspirantes.nombres as nombres','aspirantes.apellidos as apellidos','formularios_perfiles.estado_civil as estado_civil','formularios_perfiles.pasaporte as pasaporte','formularios_perfiles.celular2 as celular2','formularios_perfiles.licencia_conducir as licencia_conducir','formularios_perfiles.nup as nup','formularios_perfiles.nivel_idioma as nivel_idioma','formularios_perfiles.enfermedad_cronica as enfermedad_cronica','formularios_perfiles.enfermedad_mencion as enfermedad_mencion','formularios_perfiles.medicamento_perma as medicamento_perma','formularios_perfiles.medicamento_mencion','formularios_perfiles.discapacidad as discapacidad','formularios_perfiles.cursos_informacion as cursos_informacion','formularios_perfiles.oficios_realizar as oficios_realizar','formularios_perfiles.idea_negocio as idea_negocio','formularios_perfiles.experiencia_laboral as experecia_laboral','formularios_perfiles.ultimo_periodo_trabajo as ultimo_periodo_trabajo','formularios_perfiles.cargo_desempenado as cargo_desempenado','formularios_perfiles.habilidades_personales as habilidades_personales','formularios_perfiles.dificultades_personales as dificultades_personales','formularios_perfiles.disponibilidad_horaria as disponibilidad_horaria','formularios_perfiles.otra_observacion','segundos_idiomas.nombre as idsegundo_idioma','formularios_perfiles.id as id','formularios_perfiles.enfermedad_mencion as enfermedad_mencion','formularios_perfiles.enfermedad_cronica as enfermedad_cronica')->where("idaspirante","=",$request->id)->get();
        return $formulario; 
    }


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
            if($lenNit == 0){
               if($lenNup == 0){
                    if($lenPas == 0){
                        if($lenLic == 0){
                           
                              /*Codigo de guarda */
                           DB::beginTransaction();
                           $perfil = new FormularioPerfiles();
                           $perfil->id_egresado = $request->id_egresado;
                           $perfil->id_carrera = $request->id_carrera;
                           $perfil->lugar_nac = $request->lugar_nac;
                           $perfil->celular2 = $request->celular2;
                           $perfil->estado_civil = $request->estado_civil;
                           $perfil->nit = $request->nit;
                           if ($request->pasaporte === null) {

                            $perfil->pasaporte = '0';
                           }else{
                            $perfil->pasaporte = $request->pasaporte;
                           }
                           if ($request->licencia_conducir === null) {
                              $perfil->licencia_conducir = '0';
                           }else{
                              $perfil->licencia_conducir = $request->licencia_conducir;
                           }
                           if ($request->nup === null) {
                             $perfil->nup = '0';
                           } else {
                            $perfil->nup = $request->nup;
                           }
                           $perfil->idsegundo_idioma = $request->idsegundo_idioma;
                           $perfil->nivel_idioma = $request->nivel_idioma;
                           $perfil->nacionalidad = $request->nacionalidad;
                           $perfil->enfermedad_cronica = $request->enfermedad_cronica;
                           $perfil->enfermedad_mencion = $request->enfermedad_mencion;
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
                           $perfil->traslado_fuera = $request->traslado_fuera;
                           $perfil->otra_observacion = $request->otra_observacion;
                           $perfil->save();
               
                           $aspirante =  Egresado::findOrFail($id= $perfil->id_egresado);
                           $aspirante->formulario_perfil = 'Si';
                           $aspirante->save();
                           
                        }else{
                            return response()->json([
                                'res' => false,
                                'msg' =>"licencia existe", 
                            ],200);
                        }
                    }else{
                        return response()->json([
                            'res' => false,
                            'msg' =>"pasaporte existe",
                        ],200);
                    }
               }else{
                    return response()->json([
                        'res' => false,
                        'msg' =>"nup exite",
                    ],200);
               }
                
            }else{
                return response()->json([
                'res' => false,
                'msg' =>"nit existe",
            ],200);
                
            }
            

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

   
  
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
        $perfil->enfermedad_mencion = $request->enfermedad_mencion;
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
   
    public function updateDerivacion(Request $request)
    {
      $usuario = FormularioPerfiles::findOrFail($request->id);
      $usuario->recomendacion_derivacion = $request->recomendacion_derivacion;
      $usuario->save();
     
    }
    public function controlList()
    {
      $formulario = FormularioPerfiles::join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('alumnos','alumnos.id_egresado','=','egresados.id')->join('aspirantes','alumnos.idaspirantes','=','aspirantes.id')->join('anio_graduacion','formularios_perfiles.id_anio_graduacion','=','anio_graduacion.id')->join('carreras','formularios_perfiles.id_carrera','=','carreras.id')->join('segundos_idiomas','formularios_perfiles.idsegundo_idioma','=','segundos_idiomas.id')->select('aspirantes.nombres as nombres','aspirantes.apellidos as apellidos','egresados.fecha_nac as fecha_nac','egresados.direccion as direccion','egresados.celular as celular','egresados.dui as dui','carreras.nombre as carrera','anio_graduacion.anio as anio','segundos_idiomas.nombre as segundo_idioma','formularios_perfiles.lugar_nac as lugar_nac','formularios_perfiles.celular2 as celular2','formularios_perfiles.estado_civil as estado_civil','formularios_perfiles.nit as nit','formularios_perfiles.pasaporte as pasaporte','formularios_perfiles.licencia_conducir as licencia_conducir','formularios_perfiles.nup as nup','formularios_perfiles.nivel_idioma as nivel_idioma','formularios_perfiles.nacionalidad as nacionalidad','formularios_perfiles.enfermedad_cronica as enfermedad_cronica','formularios_perfiles.enfermedad_mencion as enfermedad_mencion','formularios_perfiles.medicamento_perma as medicamento_perma','formularios_perfiles.medicamento_mencion as medicamento_mencion','formularios_perfiles.discapacidad as discapacidad','formularios_perfiles.nivel_academico as nivel_academico','formularios_perfiles.institucion_formadora as institucion_formadora','formularios_perfiles.cursos_informacion as cursos_informacion','formularios_perfiles.oficios_realizar as oficios_realizar','formularios_perfiles.formacion_emprende as formacion_emprede','formularios_perfiles.idea_negocio as idea_negocio','formularios_perfiles.instituto_formador_emprede as instituto_formador_emprede','formularios_perfiles.anio_formacion as anio_formacion','formularios_perfiles.experiencia_laboral as experiencia_laboral','formularios_perfiles.ultimo_periodo_trabajo as ultimo_periodo_trabajo','formularios_perfiles.cargo_desempenado as cargo_desempenado','formularios_perfiles.habilidades_personales as habilidades_personales','formularios_perfiles.dificultades_personales as dificultades_personales','formularios_perfiles.disponibilidad_horaria as disponibilidad_horaria','formularios_perfiles.recomendacion_derivacion as recomendacion_derivacion','formularios_perfiles.otra_observacion','formularios_perfiles.created_at as fecha_creacion','formularios_perfiles.id as id','formularios_perfiles.traslado_fuera as traslado_fuera')->where("seguimiento_completado","=","No")->first();
        return $formulario;  

    }
}
