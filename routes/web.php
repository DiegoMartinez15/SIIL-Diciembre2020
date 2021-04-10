<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aspirantes_list', 'FormularioSeguimientController@index');
Route::post("/perfil","FormularioPerfilController@store"); 
Route::post("perfil/save","FormularioPerfilController@create");
Route::post('/showform2', 'ControlSeguimientoController@showSecondForm');
Route::get('/controlList', 'ControlSeguimientoController@index');  

Route::get('enviar',function(){
    $data = [
      'link' => 'https://jesuschicano.es'
    ];
    \Mail::send('emails.notificacion', $data, function($msg){
       $msg->from('jesus@shivaweb.es', 'Jesús chicano');
     $msg->to('user@example.com')->subject('Notificación');
    });
 }
);

