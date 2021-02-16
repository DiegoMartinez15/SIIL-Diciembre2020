<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Aspirante;
use App\FormularioPerfiles;
use App\FormularioSeguimiento;
use App\Egresados;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormularioSeguimientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $formulario = Aspirante::join('formularios_perfiles','aspirantes.id','=','formularios_perfiles.id_aspirante')->join('egresados','formularios_perfiles.id_egresado','=','egresados.id')->join('carreras','aspirantes.idcarrera','=','carreras.id')->select('aspirantes.nombres as nombre','aspirantes.apellidos as apellido','aspirantes.telefono','egresados.correo as correo','formularios_perfiles.celular2 as celular2','carreras.nombre as carrera','aspirantes.id as id_aspirante','egresados.id as id_egresado')->where("formulario_perfil","=","Si")->where("formulario_seguimiento","=","No")->get();
        return $formulario;
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            DB::beginTransaction();
            $seguimiento = FormularioSeguimiento();
            $seguimiento->id_aspirante = $request->id_aspirante;
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
            $seguimiento->save();

            $aspirante =  Aspirante::findOrFail($id= $perfil->id_aspirante);
            $aspirante->formulario_seguimiento = 'Si';
            $aspirante->save();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
