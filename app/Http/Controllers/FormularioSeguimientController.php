<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Aspirante;
use App\Egresado;
use App\FormularioPerfiles;
use App\FormularioSeguimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormularioSeguimientController extends Controller
{

   
  
    public function index()
    {

        $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado')->where("formulario_perfil","=","Si")->where("seguimiento1","=","No")->get();
        return $formulario;
    } 
    public function index2()
    {

        $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado')->where("formulario_perfil","=","Si")->where("seguimiento1","=","Si")->where("seguimiento2","=","No")->get();
        return $formulario;
    } 
    public function index3()
    {

        $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado')->where("formulario_perfil","=","Si")->where("seguimiento2","=","Si")->where("seguimiento3","=","No")->get();
        return $formulario;
    } 
    public function index4()
    {

        $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado')->where("formulario_perfil","=","Si")->where("seguimiento3","=","Si")->where("seguimiento4","=","No")->get();
        return $formulario;
    } 

   
    public function create(Request $request)
    {

        try{
            DB::beginTransaction();
            $seguimiento = new FormularioSeguimiento();
            $seguimiento->id_egresado = $request->id_egresado;
            $seguimiento->continua_estudiando = $request->continua_estudiando;
            $seguimiento->empleado = $request->empleado;
            $seguimiento->empleado_area_trabajo = $request->empleado_area_trabajo;
            $seguimiento->interes_colocado = $request->interes_colocado;
            $seguimiento->tipo_empleo = $request->tipo_empleo;
            $seguimiento->nombre_empresa = $request->nombre_empresa;
            $seguimiento->contacto_empresa = $request->contacto_empresa;
            $seguimiento->cargo_desempenia = $request->cargo_desempenia;
            $seguimiento->tel_empresa = $request->tel_empresa;
            $seguimiento->estatus = $request->estatus;
            $seguimiento->trimestre = '1';
            $seguimiento->save();

            $aspirante =  Egresado::findOrFail($id= $seguimiento->id_egresado);
            $aspirante->seguimiento1 = "Si";
            $aspirante->save();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function create2(Request $request)
    {
        try{
            DB::beginTransaction();
            $seguimiento = new FormularioSeguimiento();
            $seguimiento->id_egresado = $request->id_egresado;
            $seguimiento->continua_estudiando = $request->continua_estudiando;
            $seguimiento->empleado = $request->empleado;
            $seguimiento->interes_colocado = $request->interes_colocado;
            $seguimiento->empleado_area_trabajo = $request->empleado_area_trabajo;
            $seguimiento->tipo_empleo = $request->tipo_empleo;
            $seguimiento->nombre_empresa = $request->nombre_empresa;
            $seguimiento->contacto_empresa = $request->contacto_empresa;
            $seguimiento->cargo_desempenia = $request->cargo_desempenia;
            $seguimiento->tel_empresa = $request->tel_empresa;
            $seguimiento->estatus = $request->estatus;
            $seguimiento->fecha_monitoreo = $request->fecha_monitoreo;
            $seguimiento->trimestre = '2';
            $seguimiento->save();

            $aspirante =  Egresado::findOrFail($id= $seguimiento->id_egresado);
            $aspirante->seguimiento2 = 'Si';
            $aspirante->save();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function create3(Request $request)
    {
        try{
            DB::beginTransaction();
            $seguimiento = new FormularioSeguimiento();
            $seguimiento->id_egresado = $request->id_egresado;
            $seguimiento->continua_estudiando = $request->continua_estudiando;
            $seguimiento->empleado = $request->empleado;
            $seguimiento->interes_colocado = $request->interes_colocado;
            $seguimiento->empleado_area_trabajo = $request->empleado_area_trabajo;
            $seguimiento->tipo_empleo = $request->tipo_empleo;
            $seguimiento->nombre_empresa = $request->nombre_empresa;
            $seguimiento->contacto_empresa = $request->contacto_empresa;
            $seguimiento->cargo_desempenia = $request->cargo_desempenia;
            $seguimiento->tel_empresa = $request->tel_empresa;
            $seguimiento->estatus = $request->estatus;
            $seguimiento->fecha_monitoreo = $request->fecha_monitoreo;
            $seguimiento->trimestre = '3';
            $seguimiento->save();

            $aspirante =  Egresado::findOrFail($id= $seguimiento->id_egresado);
            $aspirante->seguimiento3 = 'Si';
            $aspirante->save();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function create4(Request $request)
    {
        try{
            DB::beginTransaction();
            $seguimiento = new FormularioSeguimiento();
            $seguimiento->id_egresado = $request->id_egresado;
            $seguimiento->continua_estudiando = $request->continua_estudiando;
            $seguimiento->empleado = $request->empleado;
            $seguimiento->interes_colocado = $request->interes_colocado;
            $seguimiento->empleado_area_trabajo = $request->empleado_area_trabajo;
            $seguimiento->tipo_empleo = $request->tipo_empleo;
            $seguimiento->nombre_empresa = $request->nombre_empresa;
            $seguimiento->contacto_empresa = $request->contacto_empresa;
            $seguimiento->cargo_desempenia = $request->cargo_desempenia;
            $seguimiento->tel_empresa = $request->tel_empresa;
            $seguimiento->estatus = $request->estatus;
            $seguimiento->fecha_monitoreo = $request->fecha_monitoreo;
            $seguimiento->trimestre = '4';
            $seguimiento->save();

            $aspirante =  Egresado::findOrFail($id= $seguimiento->id_egresado);
            $aspirante->seguimiento4 = 'Si';
            $aspirante->save();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

   
    public function listS1()
    {
         $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('formularios_seguimientos','aspirantes.id','=','formularios_seguimientos.id_aspirante')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado','formularios_seguimientos.continua_estudiando as continua_estudiando','formularios_seguimientos.empleado as empleado','formularios_seguimientos.empleado_area_trabajo as empleado_area_trabajo','formularios_seguimientos.interes_colocado as interes_colocado','formularios_seguimientos.tipo_empleo as tipo_empleo','formularios_seguimientos.nombre_empresa as nombre_empresa','formularios_seguimientos.contacto_empresa as contacto_empresa','formularios_seguimientos.cargo_desempenia as cargo_desempenia','formularios_seguimientos.tel_empresa as tel_empresa','formularios_seguimientos.estatus as estatus','formularios_seguimientos.fecha_monitoreo as fecha_monitoreo')->where("formulario_perfil","=","Si")->where("seguimiento1","=","Si")->where("trimestre","=","1")->get();
        return $formulario;
    }

    public function listS2()
    {
         $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('formularios_seguimientos','aspirantes.id','=','formularios_seguimientos.id_aspirante')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado','formularios_seguimientos.continua_estudiando as continua_estudiando','formularios_seguimientos.empleado as empleado','formularios_seguimientos.empleado_area_trabajo as empleado_area_trabajo','formularios_seguimientos.interes_colocado as interes_colocado','formularios_seguimientos.tipo_empleo as tipo_empleo','formularios_seguimientos.nombre_empresa as nombre_empresa','formularios_seguimientos.contacto_empresa as contacto_empresa','formularios_seguimientos.cargo_desempenia as cargo_desempenia','formularios_seguimientos.tel_empresa as tel_empresa','formularios_seguimientos.estatus as estatus','formularios_seguimientos.fecha_monitoreo as fecha_monitoreo')->where("formulario_perfil","=","Si")->where("seguimiento1","=","Si")->where("seguimiento2","=","Si")->where("trimestre","=","2")->get();
        return $formulario;
    }

    public function listS3()
    {
         $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('formularios_seguimientos','aspirantes.id','=','formularios_seguimientos.id_aspirante')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado','formularios_seguimientos.continua_estudiando as continua_estudiando','formularios_seguimientos.empleado as empleado','formularios_seguimientos.empleado_area_trabajo as empleado_area_trabajo','formularios_seguimientos.interes_colocado as interes_colocado','formularios_seguimientos.tipo_empleo as tipo_empleo','formularios_seguimientos.nombre_empresa as nombre_empresa','formularios_seguimientos.contacto_empresa as contacto_empresa','formularios_seguimientos.cargo_desempenia as cargo_desempenia','formularios_seguimientos.tel_empresa as tel_empresa','formularios_seguimientos.estatus as estatus','formularios_seguimientos.fecha_monitoreo as fecha_monitoreo')->where("formulario_perfil","=","Si")->where("seguimiento1","=","Si")->where("seguimiento2","=","Si")->where("seguimiento3","=","Si")->where("trimestre","=","3")->get();
        return $formulario;
    }
    public function listS4()
    {
         $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('formularios_seguimientos','aspirantes.id','=','formularios_seguimientos.id_aspirante')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado','formularios_seguimientos.continua_estudiando as continua_estudiando','formularios_seguimientos.empleado as empleado','formularios_seguimientos.empleado_area_trabajo as empleado_area_trabajo','formularios_seguimientos.interes_colocado as interes_colocado','formularios_seguimientos.tipo_empleo as tipo_empleo','formularios_seguimientos.nombre_empresa as nombre_empresa','formularios_seguimientos.contacto_empresa as contacto_empresa','formularios_seguimientos.cargo_desempenia as cargo_desempenia','formularios_seguimientos.tel_empresa as tel_empresa','formularios_seguimientos.estatus as estatus','formularios_seguimientos.fecha_monitoreo as fecha_monitoreo')->where("formulario_perfil","=","Si")->where("seguimiento1","=","Si")->where("seguimiento2","=","Si")->where("seguimiento3","=","Si")->where("seguimiento4","=","Si")->where("trimestre","=","4")->get();
        return $formulario;
    }

}
