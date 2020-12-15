<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequisitosOferta;
class RequisitoController extends Controller
{

   
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {   

        $requisito =RequisitosOferta::join('oferta','requisitos.idoferta','=','oferta.id')
        ->join('empresas','oferta.idempresa','=','empresas.id')
        ->join('usuarios','oferta.idusuario','=','usuarios.id')
        ->select('requisitos.*',
        'oferta.img as img','oferta.salario as salario','empresas.nombre as idempresa','usuarios.nombres as idusuarios')
        ->Where("requisitos.id",$request->id)->get();

        return $requisito;
            

        //$requisito=RequisitosOferta::where("id",$request->id)->get();
        //return $requisito;
    }

    
    public function maximo(){
        $requisito =RequisitosOferta::max('id');
        return $requisito;
    }
 
}
