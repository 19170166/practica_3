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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ver','Controller@vertoken');
Route::get('/mostrar/usuario/{id?}','ControladorUsuario@mostrarusuarios')->where('id','[0-9]+');
Route::get('/mostrar/producto/{id?}','ControladorProducto@mostrarproducto')->where('id','[0-9]+');
Route::get('/mostrar/comentario/producto/{id?}','ControladorComentario@mostrarcomentarios')->where('id','[0-9]+');
Route::get('/mostrar/comentario/usuario/{id?}','ControladorComentario@mostrarcomentarios2')->where('id','[0-9]+');
Route::get('/mostrar/comentario/{id?}','ControladorComentario@mostrarcomentarios3')->where('id','[0-9]+');

Route::post('/registrar','Controller@registro');
Route::post('/login','Controller@login')->middleware('checkuser');
Route::post('/agregar/comentario','ControladorComentario@agregarcomentario')->middleware('checkuser');
Route::post('/agregar/producto','ControladorProducto@agregarproducto')->middleware('checkuser');
Route::post('/correo','ControladorMail@correoprueba');
Route::post('/subir/imagen/{id?}','ControladorUsuario@subirimagen');

Route::put('/modificar/comentario/{id?}','ControladorComentario@modificarcomentario')->where('id','[0-9]+');
Route::put('/modificar/producto/{id?}','ControladorProducto@modificarproducto')->where('id','[0-9]+');
Route::put('/modificar/usuario/{id?}','ControladorUsuario@modificarusuario')->where('id','[0-9]+');
Route::put('/modificar/permisos/{id?}','Controller@modificarpermiso')->where('id','[0-9]+')->middleware('checkadmin');

Route::get('/actualizar/cuenta/{id}','ControladorMail@verificarusuario')->where('id','[0-9]+');

Route::delete('/borrar/comentario/{id?}','ControladorComentario@eliminarcomentario')->where('id','[0-9]+');
Route::delete('/borrar/producto/{id?}','ControladorProducto@eliminarproducto')->where('id','[0-9]+');
Route::delete('/borrar/usuario/{id?}','ControladorUsuario@eliminarusuario')->where('id','[0-9]+');
Route::delete('logout','Controller@logout');
