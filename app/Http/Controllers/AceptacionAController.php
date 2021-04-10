<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\FormAccept;
use App\User;
use App\Aspirante;
use App\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AceptacionAController extends Controller
{
    public function aceptacionA(Request $request)
    {

        try{

            DB::beginTransaction();
            $form = new FormAccept();
            $form->acepto = 'NO';
            $form->porque = $request->motivo;
            $form->save();

            $formconsulta = FormAccept::orderBy('id','DESC')->first();
            $formid = $formconsulta->id;

            if ($formid != null) {
                $newu = new User();
                $newu->estado = 'I';
                $newu->idform_accept = $formid;
                $newu->idtipo_usuario = '2';
                $newu->idaspirante = $request->id_aspirante;
                $newu->save();
            }
            

            $userconsulta = User::orderBy('id','DESC')->first();
            $userid = $userconsulta->id;

            if ($userid != null) {

                $aspirante = Aspirante::FindOrFail($request->id_aspirante);
                $aspirante->idusers = $userid;
                $aspirante->save();
              
            }

           
        }catch (Exception $e) {

             DB::rollBack();
            return $e->getMessage();
        }
       
    }
}
