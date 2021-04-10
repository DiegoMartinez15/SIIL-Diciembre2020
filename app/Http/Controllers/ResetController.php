<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\User;
use App\Aspirante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetController extends Controller
{
     public  function Reset(Request $request)
    {
        try{
            DB::beginTransaction();
           $aspirante = DB::table('alumnos')
              ->where('seguimiento4','=', 'Si')
              ->update(['seguimiento_completado' => $request->seguimiento_completado]);

              $usuario = DB::table('users')
              ->where('idtipo_usuario','=', 2)
              ->update(['estado' => $request->estado]);
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
