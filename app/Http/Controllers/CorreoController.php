<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function send(Request $request){
        $contenido->correo = 'cv19001@itcha.edu.sv';
        $contenido->Nombre = 'Josue Castillo';
        $contenido->mensaje = 'ya cayo puto';
        
        
        Mail::to('cv19001@itcha.edu.sv')->send(new CorreoResivido($contenido));
    }
}
