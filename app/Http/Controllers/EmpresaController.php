<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    public function index(){
        

        $empresas =Empresa::join('usuarios','empresas.idusuario','=','usuarios.id')
        ->join('areas', 'empresas.idarea', '=', 'areas.id')
        ->select('empresas.id','empresas.nombre','empresas.direccion',
        'empresas.telefono','empresas.encargado','areas.nombre as idarea','usuarios.nombres as idusuario'
        
        )->get();



        //$empresa = Empresa::join('areas','empresas.idarea','=','areas.id')
        //->join('coordinadores','empresas.idcoordinador','=','coodinadores.id')
         // ->select('empresas.id','empresas.nombre','empresas.direccion','empresas.telefono','empresas.encargado','empresas.idarea','empresas.idcoordinador',
        //'areas.nombre as idarea','coordinadores.nombre as idcoordinador')->get();
       
       return $empresas;
  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Empresa $empresa)
    {
        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->encargado = $request->encargado;
        $empresa->idarea = $request->idarea;
        $empresa->idusuario = $request->idusuario;
        
        $empresa->save();
    }

    public function update(Request $request, Empresa $empresa)
    {
        $empresa = Empresa::findOrfail($request->id);
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->encargado = $request->encargado;
        $empresa->idarea = $request->idarea;
        $empresa->idusuario = $request->idusuario;
        $empresa->save();
    }
    public function destroy($id)
    {
        $empresa =Empresa::findOrfail($id);
        $empresa->delete();
        
    }
}
