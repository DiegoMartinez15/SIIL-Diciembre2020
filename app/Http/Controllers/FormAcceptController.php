<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FormAccept;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class FormAcceptController extends Controller
{
    public function formAccept(Request $request){

        DB::beginTransaction();
            try {
                $form = $request->all();
                DB::table('form_accept')->insert($form);        
                
                    $last = DB::table('form_accept')->latest('id')->first();
                    $last = $last->id;
                    $var = $request->acepto;
                    
                    if($var == "SI"){
                        $user = auth()->user();
                        $users =User::findOrfail($user->id);
                        $users->estado = "A";
                        $users->idform_accept = $last;
                        $users->save();
                        DB::commit();
                        return $users;
                    
                    }else{
                        $user = auth()->user();
                        $users =User::findOrfail($user->id);
                        $users->estado = "I";
                        $users->idform_accept = $last;
                        $users->save();
                        DB::commit();
                        return $users;
                    }
            }
            catch (Exception $e) {
                DB::rollBack();
                throw $e;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $users;
    }
    /*public function form(Request $request){
        
        $form = $request->all();        
        DB::table('form_accept')->insert($form); 
        $last = FormAccept::orderBy('id','DESC')->first();
        $last = $last->id;
        $var = $request->acepto;
        if($var == "SI"){
             
            $user = auth()->user();
            $users =User::findOrfail($user->id);
            $users->estado = "A";
            $users->idform_accept = $last;
            $users->save();

        }else{

            $user = auth()->user();
            $users =User::findOrfail($user->id);
            $users->estado = "I";
            $users->idform_accept = $last;
            $users->save();
        }
                
       
    }*/
        

      

}

