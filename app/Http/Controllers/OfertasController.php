<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Oferta;
use App\RequisitosOferta;
use Illuminate\Support\Facades\DB;


class OfertasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ofertas = Oferta::join('empresas','oferta.idempresa','=','empresas.id')
        ->join('areas','empresas.idarea','=','areas.id')
        ->join('usuarios','empresas.idusuario','=','usuarios.id')
        ->select('oferta.id','oferta.cargo','oferta.salario','oferta.idrequisito','oferta.img','oferta.lugar_trabajo','oferta.vacante','oferta.contacto','empresas.nombre as idempresa','empresas.id as valueid','empresas.direccion as direccion','empresas.telefono as telefono'
        ,'empresas.encargado as encargado','areas.nombre as idarea','usuarios.nombres as usuario')
        ->where("estado","=","A")
        ->orderBy('id','DESC')->paginate(6);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function update()
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
               'horario' => $request->horario,
               'comicion' => $request->comiciones,
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
                               'lugar_trabajo' => $request->lugar_trabajo,
                               'contacto' => $request->contacto,
                               'vacante' => $request->vacantes,
                               'estado' => "A",
                           ]); 
                           $request->img->move($destino,$nombre);
                           $last1 = DB::table('oferta')->latest('id')->first();
                           $upd = RequisitosOferta::find($last->id);
                           $upd->idoferta = $last1->id;
                           $upd->save();
                       }else{
                        DB::rollBack();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findworklist(Request $request)
    {
        
            $ofertas = Oferta::join('empresas', 'oferta.idempresa', '=', 'empresas.id')
                ->join('areas', 'empresas.idarea', '=', 'areas.id')
                ->join('usuarios', 'empresas.idusuario', '=', 'usuarios.id')
                ->select('oferta.id', 'oferta.cargo', 'oferta.salario', 'oferta.idrequisito', 'oferta.img','oferta.lugar_trabajo','oferta.vacante','oferta.contacto','oferta.estado', 'empresas.nombre as idempresa','empresas.id as valueid', 'empresas.direccion as direccion', 'empresas.telefono as telefono', 'empresas.encargado as encargado', 'areas.nombre as idarea', 'usuarios.nombres as usuario')
                
                ->where("oferta.estado","=","A")
                ->where("oferta.lugar_trabajo","=", $request->nombre)
                ->orderBy('id', 'DESC')->paginate(15);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function findWork(){
        $ofertas =Oferta::orderBy('id','DESC')
        ->select('oferta.id','oferta.lugar_trabajo')
        ->where('oferta.estado','=','A')
        ->get();
        return $ofertas;
  
    }
    public function actualizar(Request $request){
        try{
            DB::beginTransaction();
            $form = $request->all();
            
            
                if ($form != null) {
                    $oferta = Oferta::findOrfail($request->id);
                    $oferta->cargo = $request->cargo;
                    $oferta->img = $request->img;
                    $oferta->salario = $request->salario;
                    $oferta->vacante = $request->vacante;
                    $oferta->idempresa  = $request->valueid;
                    $oferta->contacto = $request->contacto;
                    $oferta->lugar_trabajo = $request->lugar_trabajo;
                    $oferta->save();
                    
                    $requisitos = RequisitosOferta::findOrfail($request->idrequisito);
                    $requisitos->genero = $request->genero;
                    $requisitos->edad = $request->edad;
                    $requisitos->nivel_academico = $request->nivel_academico;
                    $requisitos->horario = $request->horario;
                    $requisitos->licencia = $request->licencia;
                    $requisitos->experiencia = $request->experiencia;
                    $requisitos->ambiente = $request->ambiente;
                    $requisitos->comicion = $request->comicion;
                    $requisitos->prestaciones = $request->prestaciones;
                    $requisitos->conocimiento = $request->conocimiento;
                    $requisitos->save();
                    
                }else{
                    DB::rollBack();
                    return response()->json([
                        'res' => true,
                        'message' => "No se Logro Actualizar la Oferta",
                        
                    ], 200);
                }
            
            DB::commit(); 
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    //Metodo para subir Imagen al servidor y obtener el nombre
    public function uploadImages(Request $request){
        $imagen = $request->file('img');
        
        
        $nombre =time().'.'.$imagen->getClientOriginalExtension();
        $destino = public_path('../siil-front/public/ImgOfertas');
        $request->img->move($destino,$nombre);
        return $nombre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oferta =Oferta::findOrfail($id);
       
        $oferta->estado = "I";        
        $oferta->save();
    }


    public function find(Request $request){
        if ($request->nombre == 'Todas') {
            $ofertas = Oferta::join('empresas', 'oferta.idempresa', '=', 'empresas.id')
            ->join('areas', 'empresas.idarea', '=', 'areas.id')
            ->join('usuarios', 'empresas.idusuario', '=', 'usuarios.id')
            ->select('oferta.id', 'oferta.cargo', 'oferta.salario', 'oferta.idrequisito', 'oferta.img','oferta.lugar_trabajo','oferta.vacante','oferta.contacto', 'empresas.nombre as idempresa', 'empresas.direccion as direccion', 'empresas.telefono as telefono', 'empresas.encargado as encargado', 'areas.nombre as idarea', 'usuarios.nombres as usuario')
            ->where("estado","=","A")
            ->orderBy('id', 'DESC')->paginate(6);
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
        } else {
            $ofertas = Oferta::join('empresas', 'oferta.idempresa', '=', 'empresas.id')
                ->join('areas', 'empresas.idarea', '=', 'areas.id')
                ->join('usuarios', 'empresas.idusuario', '=', 'usuarios.id')
                ->select('oferta.id', 'oferta.cargo', 'oferta.salario', 'oferta.idrequisito', 'oferta.img','oferta.lugar_trabajo','oferta.vacante','oferta.contacto', 'empresas.nombre as idempresa', 'empresas.direccion as direccion', 'empresas.telefono as telefono', 'empresas.encargado as encargado', 'areas.nombre as idarea', 'usuarios.nombres as usuario')
                ->where("areas.nombre", $request->nombre)
                ->where("estado","=","A")
                ->orderBy('id', 'DESC')->paginate(15);
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
}