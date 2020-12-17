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
        'empresas.telefono','empresas.encargado','empresas.correo','empresas.telencargado','areas.nombre as idarea',
        'usuarios.nombres as idusuario'
        
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
    public function store(Request $request , Empresa $empresas)
    {
        $empresas = new Empresa();
        $empresas->nombre = $request->nombre;
        $empresas->direccion = $request->direccion;
        $empresas->telefono = $request->telefono;
        $empresas->encargado = $request->encargado;
        $empresas->correo = $request->correo;
        $empresas->telencargado = $request->telencargado;
        $empresas->idarea = $request->idarea;
        $empresas->idusuario = $request->idusuario;
        
        $empresas->save();
    }

    public function update(Request $request, Empresa $empresas)
    {
        $empresas = Empresa::findOrfail($request->id);
        $empresas->nombre = $request->nombre;
        $empresas->direccion = $request->direccion;
        $empresas->telefono = $request->telefono;
        $empresas->encargado = $request->encargado;
        $empresas->correo = $request->correo;
        $empresas->telencargado = $request->telencargado;
        $empresas->idarea = $request->idarea;
        $empresas->idusuario = $request->idusuario;
        $empresas->save();
    }
    public function destroy($id)
    {
        $empresas =Empresa::findOrfail($id);
        $empresas->delete();
        
    }
}
