<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user',function (Request $request){
    return $request->user();
});

/* Rutas de login no touch */
Route::post('users', 'UserController@store');
Route::post('login', 'UserController@login');
/* Aqui termina rutas login */



//*********************************************************************
/*Proteccion de rutas lo que se coloque dentro del group sera protegidos
con la autenticacion de laravel*/
Route::group(['middleware'=>'auth:api'],function(){

    /*
    RUTAS DE OFERTAS Y COSAS DE ADMIN
    */
    Route::post('formfirst', 'FormAcceptController@formAccept');
    Route::ApiResource("areas","AreasController");
    Route::ApiResource("usuarios","UsuarioController");
    Route::ApiResource("empresas","EmpresaController");
    Route::get('logout', 'UserController@logout');
    Route::ApiResource("ofertas","OfertasController");
    Route::ApiResource("requisitos","RequisitoController");
    Route::get("requisitosUpd","RequisitoController@find");
    Route::get('/ofertasr', 'OfertasController@find');
    Route::get('/ofertasw', 'OfertasController@findWork');
    Route::get('/ofertaswl', 'OfertasController@findworklist');
    Route::delete('/ofertas/{id}', 'OfertaController@destroy');
    Route::put('/ofertasUpd/{id}', 'OfertasController@actualizar');
    Route::post('/uploadImages', 'OfertasController@uploadImages');
    Route::ApiResource("ApplyOffer","Aplicada_ofertasController");
    /*FIN*/
    Route::get('/listaccep', 'UserController@listAccept');

    Route::post('/aceptacionA/{id}', 'AceptacionAController@aceptacionA');


    /*
    RUTAS DE CONTROL DE SEGUIMIENTO
    */
    Route::put('/reset', 'ResetController@Reset');
    Route::get('/formularioList', 'FormularioSeguimientController@index');
    Route::get('/formularioList2', 'FormularioSeguimientController@index2');
    Route::get('/formularioList3', 'FormularioSeguimientController@index3');
    Route::get('/formularioList4', 'FormularioSeguimientController@index4');
    Route::get('/seguimiento1', 'FormularioSeguimientController@listS1');
    Route::get('/seguimiento2', 'FormularioSeguimientController@listS2');
    Route::get('/seguimiento3', 'FormularioSeguimientController@listS3');
    Route::get('/seguimiento4', 'FormularioSeguimientController@listS4');
    Route::post('/seguimientoSave', 'FormularioSeguimientController@create');
    Route::post('/seguimientoSave2', 'FormularioSeguimientController@create2');
    Route::post('/seguimientoSave3', 'FormularioSeguimientController@create3');
    Route::post('/seguimientoSave4', 'FormularioSeguimientController@create4');

    /*FIN*/
    /*
    RUTAS DE EGRESADO
    */
    Route::get('/aspirante/{id}', 'AspiranteController@index'); 
    Route::get('/formulario/list/{id}', 'FormularioPerfilController@index');
    Route::get('/formulario/all', 'FormularioPerfilController@controlList');
    Route::put("perfil/update","FormularioPerfilController@update");
    Route::put("/derivacion/update/{id}","FormularioPerfilController@updateDerivacion"); 
    Route::put("/anio_graduacion/update","AnioGraduacionController@update"); 
    Route::ApiResource("idioma","SegundoIdiomaController");
    Route::ApiResource("carreras","CarreraController"); 
    Route::ApiResource("perfil","FormularioPerfilController"); 
    Route::ApiResource("anio_graduacion","AnioGraduacionController");   
    /*FIN*/

});
/* FIN de Group */
//***************************************************************************/











