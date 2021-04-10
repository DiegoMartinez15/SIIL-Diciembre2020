<?php

namespace App\Http\Controllers;

use App\Aspirante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

class AspiranteController extends Controller
{
   
    public function index(Request $request)
    {
        $aspirante = Aspirante::join('alumnos','alumnos.idaspirante','=','aspirantes.id',)->join('egresados','alumnos.id_egresado','=','egresados.id')->select('aspirantes.nombres as nombres','aspirantes.apellidos as apellidos','alumnos.fecha_nac as fecha_nac','alumnos.direccion as direccion','alumnos.celular as celular','alumnos.dui as dui','egresados.id as id_egresado','egresados.formulario_perfil as formulario_perfil')->where("alumnos.idaspirante","=", $request->id)->first();
        return $aspirante;
        
    }

}
