<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloComentario;
use App\ModeloProducto;
use App\ModeloUsuario;
use Illuminate\Support\Facades\DB;

class ControladorComentario extends Controller
{
    public function agregarcomentario(Request $request){
        $com=new ModeloComentario();
        $com->comentario=$request->comentario;
        $com->id_usuario=$request->id_usuario;
        $com->id_producto=$request->id_producto;
        if($com->save()){
            return response()->json(['Comentario agregado',200]);
        }
        return response()->json(['Error al agregar...',400]);
    }

    public function eliminarcomentario(Request $request){
        $com=ModeloComentario::find($request->id);
        if($com->delete()){
            return response()->json(['Comentario eliminado',200]);
        }
        return response()->json(['Error al eliminar...',400]);
    }

    public function modificarcomentario(Request $request){
        $com=ModeloComentario::find($request->id);
        $com->comentario=$request->comentario;
        if($com->save()){
            return response()->json(['Comentario modificar',200]);
        }
        return response()->json(['Error al modificar...',400]);
    }

    public function mostrarcomentarios($id=null){
        $com=ModeloComentario::all();
        if($id){
            $com=DB::table('usuarios')
            ->join('comentarios','comentarios.id_usuario','=','usuarios.id')
            ->join('productos','productos.id','=','comentarios.id_producto')
            ->select('comentarios.comentario','usuarios.nombre','productos.nombre_producto')
            ->where('usuarios.id','=',$id)
            ->get();
            return $com->toJson();
        }
        $com->load('usuario','producto');
        return $com->toJson();
    }
    public function mostrarcomentarios2($id=null){
        $com=ModeloComentario::all();
        if($id){
            $com=DB::table('productos')
            ->join('comentarios','comentarios.id_producto','=','productos.id')
            ->join('usuarios','usuarios.id','=','comentarios.id_usuario')
            ->select('comentarios.comentario','usuarios.nombre','productos.nombre_producto')
            ->where('productos.id','=',$id)
            ->get();
            return $com->toJson();
        }
        $com->load('usuario','producto');
        return $com->toJson();
    }
    public function mostrarcomentarios3($id=null){
        $com=ModeloComentario::all();
        if($id){
            $com=DB::table('comentarioS')
            ->join('productos','productos.id','=','comentarios.id_producto')
            ->join('usuarios','usuarios.id','=','comentarios.id_usuario')
            ->select('comentarios.comentario','usuarios.nombre','productos.nombre_producto')
            ->where('comentarios.id','=',$id)
            ->get();
            return $com->toJson();
        }
        $com->load('usuario','producto');
        return $com->toJson();
    }
}
