<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloUsuario;
use App\ModeloComentario;
use App\ModeloArticulo;
use App\Mail\NotificarAccion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ControladorUsuario extends Controller
{
    public function modificarusuario(Request $request,$id){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'||$usu->tokens[0]->abilities[0]=='user'){
            $usu=ModeloUsuario::where('id',$id);
            if($request->nombre!=null)
            $usu->update(['nombre'=>$request->nombre]);
            elseif($request->correo!=null)
            $usu->update(['correo'=>$request->correo_nuevo]);
            elseif($request->password!=null)
            $usu->update(['passsword'=>Hash::make($request->password)]);
            elseif($request->rol!=null)
            $usu->update(['rol'=>$request->rol]);
            if($persona->save()){
                return response()->json(['Usuario modificado correctamente']);
            }
        }
        else{
            $mensaje='Modificar un usuario';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para esta accion'); 
        }
    }

    public function eliminarusuario(Request $request,$id){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'){
            $usu=ModeloUsuario::where('id',$id)->first();
            $com=ModeloComentario::where('id_usuario',$id);
            if($com->delete()&&$usu->delete()){
            return response()->json(['Usuario eliminado'],200);
            }
            return response()->json(['Error al eliminar...',400]);
        }
        else{
            $mensaje='Eliminar un usuario';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para esta accion'); 
        }
    }

    public function mostrarusuarios(Request $request,$id=null){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'){
            $usu=ModeloUsuario::all();
            if($id){
            return response()->json(['persona',$usu->find($id)]);
            }
            return response()->json(['personas',$usu]);
        }
        else{
            $mensaje='Mostrar un usuario';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para esta accion'); 
        }
    }

    public function subirimagen(Request $request,$id){
        $usu=ModeloUsuario::find($id);
        if($request->hasFile('imagen')){
            $imagen=$request->file('imagen')->store('public\ArchivosPublicos');
            //$path=Storage::disk('public')->put('docPublicos/ArchivosPublicos', $request->file);
            //dd($imagen);
            //return response()->json(['url_imagen'=>$request->imagen]);
            $usu->update(['url_imagen'=>$imagen]);
            return response()->json(['Aviso:'=>'Su imagen ha sido guardada satisfactoriamente','url_imagen'=>$imagen],200);
        }
        return response()->json(['error al subir el archivo'],400);
    }
}
