<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloUsuario;

class ControladorUsuario extends Controller
{
    public function modificarusuario(Request $request){
        $usu=ModeloUsuario::where('id',$request->$id);
        if($request->nombre!=null)
            $usu->update(['nombre'=>$request->nombre]);
        elseif($request->correo!=null)
            $usu->update(['correo'=>$request->correo]);
        elseif($request->password!=null)
            $usu->update(['passsword'=>$request->password]);
        elseif($request->rol!=null)
            $usu->update(['rol'=>$request->rol]);
        $persona->save();
    }

    public function eliminarusuario(Request $request){
        $usu=ModeloUsuario::where('id',$request->id);
        if($usu->delete()){
            return response()->json(['Usuario eliminado',200]);
        }
        return response()->json(['Error al eliminar...',400]);
    }

    public function mostrarusuarios($id=null){
        $usu=ModeloUsuario::all();
        if($id){
            return response()->json(['persona',$usu->find($id)]);
        }
        return response()->json(['personas',$usu]);
    }
}
