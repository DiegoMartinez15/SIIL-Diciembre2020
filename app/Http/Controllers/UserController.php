<?php

namespace App\Http\Controllers;
use App\User;
use App\Aspirante;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request){
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return response()->json([
            'res' => true,
            'message' =>"Usuario creado correctamente"
        ],200);
    }

    public function login(Request $request){
        //$user = Aspirante::whereCodigo($request->email)->first();
        $user = Aspirante::where("codigo","=",$request->email)->first();
        if($user != null){
            if($user != null && $request->password == $user->password){/**** * AQUI HAY PROBLEMA POR QUE NO SE COMO CIFRAN LA CLAVE **********/
                $tableUser = User::where("idaspirante","=",$user->id)->first();
                        if($tableUser == null){
                            $input = $user->id;
                            User::create([
                                'estado' => 'N',
                                'idform_accept'=> null,
                                'idtipo_usuario' => 2,
                                'idaspirante' => $input, 
                            ]);
                            $userid  = User::orderBy('id','DESC')->first();
                            $upd = Aspirante::find($user->id);
                            $upd->idusers = $userid->id;
                            $upd->save();
                        
                                $tableUser = User::where("idaspirante","=",$user->id)->first();
                                    if($tableUser != null){
                                        $token = $tableUser->createToken('SIILv3')->accessToken;
                                        $dataU =  Aspirante::where("codigo","=",$request->email)->first();
                                        return response()->json([
                                            'res' => true,
                                            'message' =>"Todo bien hasta ahorita primer if de creacion",
                                            'user'=>$tableUser,
                                            'token'=>$token,
                                            'dataUser'=>$dataU
                                        ],200);
                                    }else{
                                        return response()->json([
                                            'res' => true,
                                            'message' =>"Algo esta mal donde hace el token por primera ves",
                                        ],200);
                                    }
                        }else{
                            $token = $tableUser->createToken('SIILv3')->accessToken;
                            $dataU =  Aspirante::where("codigo","=",$request->email)->first();
                            return response()->json([
                                'res' => true,
                                'message' =>"Todo bien hasta ahorita ya ingreso y esta es la segunda vez if de creacion",
                                'user'=>$tableUser,
                                'token'=>$token,
                                'dataUser'=>$dataU
                            ],200);
                        }
            }else{
                return response()->json([
                    'res' => true,
                    'message' =>"Ingresa Las credenciales correctas",
                    
                    //'message' =>"El codigo o contraseña son incorrectos"
                ],200);
            }
        /* AQUI VA  SI NO EXISTE EN LA TABLA ASPIRANTE ES POR QUE ES UN USUARIO ADMINISTRADOR */
        }else{
            $userA = Usuario::where("nombres","=",$request->email)->first();
            if($userA != null){
                if($userA != null && Hash::check($request->password, $userA->password)){
                    $input = $userA->id;
                    $tableUser = User::where("idusuario","=",$userA->id)->first();
                    if($tableUser == null){
                        User::create([
                            'estado' => 'A',
                            'idform_accept'=> null,
                            'idtipo_usuario' => 1,
                            'idaspirante' => null,
                            'idusuario' => $input
                        ]);
                        $userid  = User::orderBy('id','DESC')->first();
                        $upd = Usuario::find($userA->id);
                        $upd->idusers = $userid->id;
                        $upd->save();
                   
                        $tableUser = User::where("idusuario","=",$userA->id)->first();
                        if($tableUser != null){
                            $token = $tableUser->createToken('SIILv3')->accessToken;
                            $dataU =  Usuario::where("nombres","=",$request->email)->first();
                            return response()->json([
                                'res' => true,
                                'message' =>"Todo bien hasta ahorita primer if de creacion",
                                'user'=>$tableUser,
                                'token'=>$token,
                                'dataUser'=>$dataU,
                                'prueba'=>$userid
                            ],200);
                        }else{
                            return response()->json([
                                'res' => true,
                                'message' =>"Algo esta mal donde hace el token por primera ves",
                               
                            ],200);
                        }
                    }else{
                        $token = $tableUser->createToken('SIILv3')->accessToken;
                            $dataU =  Usuario::where("nombres","=",$request->email)->first();
                            return response()->json([
                                'res' => true,
                                'message' =>"Todo bien hasta ahorita es por que ya ingreso una ves",
                                'user'=>$tableUser,
                                'token'=>$token,
                                'dataUser'=>$dataU
                            ],200);

                    }
                }else{
                    return response()->json([
                        'res' => true,
                        'message' =>"Ingresa Las credenciales correctas",
                    ],200);

                }
            }else{
                return response()->json([
                    'res' => true,
                    'message' =>"Tus credenciales no estan registradas"
                ],200);
            }
        }
    }
    public function logout(){
        $user = auth()->user();
        $user->tokens->each(function ($token, $key){
            $token->delete();
        });
        
        $user->save();
        return response()->json([
            'res' => true,
            'message' =>"adios",
            'user'=> $user
        ],200);
    }

}

