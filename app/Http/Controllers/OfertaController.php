<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Oferta;
use App\RequisitosOferta;
use DB;

class OfertaController extends Controller
{

    public function find(Request $request){
        if($request->nombre == 'Todas'){

            $ofertas = Oferta::join('empresas','oferta.idempresa','=','empresas.id')
            ->join('areas','empresas.idarea','=','areas.id')
            ->join('usuarios','empresas.idusuario','=','usuarios.id')
            ->select('oferta.id','oferta.cargo','oferta.salario','oferta.idrequisito','oferta.img','empresas.nombre as idempresa','empresas.direccion as direccion','empresas.telefono as telefono'
            ,'empresas.encargado as encargado','areas.nombre as idarea','usuarios.nombres as usuario')
            ->orderBy('id','DESC')->paginate(3);
            return [
                'pagination' => [
                    'total' => $ofertas->total(),
                    'current_page' => $ofertas->currentPage(),
                    'per_page' => $ofertas->perPage(),
                    'last_page' => $ofertas->lastPage(),
                    'from' => $ofertas->firstItem(),
                    'to' => $ofertas->lastPage(),
                ],
                'ofertas' => $ofertas
            ];
        }else{
            $ofertas = Oferta::join('empresas','oferta.idempresa','=','empresas.id')
                ->join('areas','empresas.idarea','=','areas.id')
                ->join('usuarios','empresas.idusuario','=','usuarios.id')
                ->select('oferta.id','oferta.cargo','oferta.salario','oferta.idrequisito','oferta.img','empresas.nombre as idempresa','empresas.direccion as direccion','empresas.telefono as telefono'
                ,'empresas.encargado as encargado','areas.nombre as idarea','usuarios.nombres as usuario')
                ->where("areas.nombre",$request->nombre)
                ->orderBy('id','DESC')->paginate(100);
            return [
                    'pagination' => [
                    'total' => $ofertas->total(),
                    'current_page' => $ofertas->currentPage(),
                    'per_page' => $ofertas->perPage(),
                    'last_page' => $ofertas->lastPage(),
                    'from' => $ofertas->firstItem(),
                    'to' => $ofertas->lastPage(),
                ],
                'ofertas' => $ofertas
            ];

        }
        
    }
    public function index(Request $request){
        $ofertas = Oferta::join('empresas','oferta.idempresa','=','empresas.id')
        ->join('areas','empresas.idarea','=','areas.id')
        ->join('usuarios','empresas.idusuario','=','usuarios.id')
        ->select('oferta.id','oferta.cargo','oferta.salario','oferta.idrequisito','oferta.img','empresas.nombre as idempresa','empresas.direccion as direccion','empresas.telefono as telefono'
        ,'empresas.encargado as encargado','areas.nombre as idarea','usuarios.nombres as usuario')
        ->orderBy('id','DESC')->paginate(3);
        return [
            'pagination' => [
                'total' => $ofertas->total(),
                'current_page' => $ofertas->currentPage(),
                'per_page' => $ofertas->perPage(),
                'last_page' => $ofertas->lastPage(),
                'from' => $ofertas->firstItem(),
                'to' => $ofertas->lastPage(),
            ],
            'ofertas' => $ofertas
        ];
    }

    public function store(Request $request, Oferta $ofertas, RequisitosOferta $requisitos){
        $form = $request->all();
        $imagen = $request->file('img');
        $nombre =time().'.'.$imagen->getClientOriginalExtension();
        $destino = public_path('../siil-front/public/ImgOfertas');
         
        DB::beginTransaction();
        try {
            DB::table('requisitos')->insert([
                'edad' => $request->edad,
                'genero' =>$request->genero,
                'nivel_academico' => $request->nivel_academico,
                'experiencia' => $request->experiencia,
                'horario' => $request->horarios,
                'conocimiento' => $request->conocimiento,
                'licencia' => $request->licencia,
                'ambiente' => $request->ambiente,
                'prestaciones' => $request->prestaciones,
                'idoferta' => $request->idempresa

            ]);  
            $last = DB::table('requisitos')->latest('id')->first();
            
                        if($last != null){
                            DB::table('oferta')->insert([
                                'cargo' => $request->cargo,
                                'salario'=>$request->salario,
                                'idempresa' =>$request->idempresa,
                                'idrequisito' => $last->id,
                                'idusuario' => $request->idusuario,
                                'img' => $nombre,
                            
                            ]); 
                            $request->img->move($destino,$nombre);
                            $last1 = DB::table('oferta')->latest('id')->first();
                            $upd = RequisitosOferta::find($last->id);
                            $upd->idoferta = $last1->id;
                            $upd->save();
                        }else{
                            return response()->json([
                                'res' => true,
                                'message' =>$last1,
                            ],200);
                        }
                      
                }
                catch (Exception $e) {
                    DB::rollBack();
                    throw $e;
            } catch (Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            return $form;
        }  


}


