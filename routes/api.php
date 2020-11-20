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
Route::get('/mostrar/persona/{id?}','ControladorUsuario@mostrarusuarios');
Route::get('/mostrar/producto/{id?}','ControladorProducto@mostrarproducto');
Route::get('/mostrar/comentario/producto/{id?}','ControladorComentario@mostrarcomentarios');
Route::get('/mostrar/comentario/usuario/{id?}','ControladorComentario@mostrarcomentarios2');
Route::get('/mostrar/comentario/{id?}','ControladorComentario@mostrarcomentarios3');

Route::post('/registrar','Controller@registro');
Route::post('/login','Controller@login');
Route::post('/agregar/comentario','ControladorComentario@agregarcomentario');
Route::post('/agregar/producto','ControladorProducto@agregarproducto');

Route::put('/modificar/comentario','ControladorComentario@modificarcomentario');
Route::put('/modificar/producto','ControladorProducto@modificarproducto');
Route::put('/modificar/usuario','ControladorUsuario@modificarusuario');
Route::put('/modificar/permisos','Controller@modificarpermiso')->middleware('checkadmin');

Route::delete('/borrar/comentario','ControladorComentario@eliminarcomentario');
Route::delete('/borrar/producto','ControladorProducto@eliminarproducto');
rOUTE::delete('/borrar/usuario','ControladorUsuario@eliminarusuario');
