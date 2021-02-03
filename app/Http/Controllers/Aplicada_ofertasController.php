<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Oferta;
use App\Aspirante;
use App\Aplicadas_ofertas;
use DB;

class Aplicada_ofertasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applyOffer = Aplicadas_ofertas::join('aspirantes', 'aplicadas_ofertas.idaspirantes', '=', 'aspirantes.id')

        ->join('oferta', 'aplicadas_ofertas.idoferta', '=', 'oferta.id')
        ->join('empresas','oferta.idempresa','=','empresas.id')

        ->select('aplicadas_ofertas.id', 'aplicadas_ofertas.estado', 'aspirantes.nombres as nombres','aspirantes.apellidos as apellidos',
        'aspirantes.codigo as codigo', 'aspirantes.telefono as telefono','oferta.cargo as cargo','empresas.nombre as empresa','oferta.lugar_trabajo as lugardesarrollo')
        ->where('aplicadas_ofertas.estado','A')
        ->orderBy('nombres','DESC')
        ->get();

            
      
        return $applyOffer;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           
         
        try { 
            if($request->idaspirante == null && $request->idoferta == null){
                return response()->json([
                    'res' => false,
                    'msg' => "No se pudo Aplicar a la oferta requerida",
                    
                ],200); 

            }else{
                
                $form = Aplicadas_ofertas::where('idoferta',$request->idoferta)
                ->where('idaspirantes','=',$request->idaspirante)
                ->where('estado','A')->get();
                $len = sizeof($form);
            

                if($len == 0){
                    //aqui entra si no hay registro con esta oferta aplicar y verifica si ya aplico y se despacho la solicitud

                    //de aqui empieza a verfificar si ya aplico y esta despachada la oferta
                    $form1 = Aplicadas_ofertas::where('idoferta',$request->idoferta)
                    ->where('idaspirantes','=',$request->idaspirante)
                    ->where('estado','D')->get();
                    $leng1 = sizeof($form1);
                    //Consulta si el resultado de leng1 es 0 es por que no ha aplicado a esa oferta nunca y si es 1 ya aplico pero esta despachada 
                        if($leng1 == 0){
                            //codigo para hacer el registro
                            $applyOffer = new Aplicadas_ofertas();
                            $applyOffer->estado = "A";
                            $applyOffer->idaspirantes = $request->idaspirante;
                            $applyOffer->idoferta = $request->idoferta;
                            $applyOffer->save();

                            //falta enviar la notificacion al correo del admin

                            return response()->json([
                                'res' => true,
                                'msg' => "Se Aplico correctamente",
                            ],200);
                        }else{
                            //ya aplico solo mandamos el mensaje
                            return response()->json([
                                'res' => false,
                                'msg' => "ya haz aplicado a esta oferta y se te dio respuesta",
                               
                                
                            ],200);
                        }

                }else{
                    //aqui entra si ya esta aplico a una oferta
                    return response()->json([
                        'res' => false,
                        'msg' => "ya haz aplicado",
                        
                        
                    ],200);
                }

            }
        } catch (Exception $e) { 
            return $e->getMessage();
        }

        return response()->json([
            'res' => true,
            'msg' => "Se Aplico correctamente",
            
        ],200);
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
