<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloComentario;
use App\ModeloProducto;
use App\ModeloUsuario;
use App\Mail\NotificarAccion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ControladorComentario extends Controller
{
    public function agregarcomentario(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        return $usu;
        if($usu->tokens[0]->abilities[0]=='admin'||$usu->tokens[0]->abilities[0]=='user'){
            $com=new ModeloComentario();
            $com->comentario=$request->comentario;
            $com->id_usuario=$usu->id;
            $com->id_producto=$request->id_producto;
            if($com->save()){
                return response()->json(['Comentario agregado',200]);
            }
            return response()->json(['Error al agregar...',400]);
        }
        else{
            $mensaje='Agregar un comentario';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para acceder'); 
        }
    }

    public function eliminarcomentario(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'||$usu->tokens[0]->abilities[0]=='user'){
        $com=ModeloComentario::find($request->id);
        if($com->delete()){
            return response()->json(['Comentario eliminado',200]);
        }
        return response()->json(['Error al eliminar...',400]);
        }
        else{
        $mensaje='Eliminar un comentario';
        Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
        return abort(400,'No tiene permiso para acceder'); 
        }
    }

    public function modificarcomentario(Request $request,$id){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'||$usu->tokens[0]->abilities[0]=='user'){
            $com=ModeloComentario::find($id);
            return $com;
            $com->update(['comentario'=>$request->comentario]);
            //$com->comentario=$request->comentario;
            if($com->save()){
                return response()->json(['Comentario modificado',200]);
            }
            return response()->json(['Error al modificar...',400]);
            }
        else{
            $mensaje='Modificar un comentario';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para acceder'); 
        }
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
//3|i3bNdAamLQd8y626jpoesmpOkGili3HOztzTAmKp