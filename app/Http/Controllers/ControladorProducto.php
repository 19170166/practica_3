<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloProducto;
use App\ModeloUsuario;


class ControladorProducto extends Controller
{
    public function agregarproducto(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        //return response()->json([$usu,$usu->tokens[0]->abilities[0]]);
        if($usu->tokens[0]->abilities[0]=="vendedor"||$usu->tokens[0]->abilities[0]=="admin"){
            $pro=new ModeloProducto();
            $pro->nombre_producto=$request->nombre_producto;
            if ($pro->save()) {
            return response()->json(['Producto registrado',$pro],200);
        }
        return response()->json('Producto no registrado...');
        }
        return abort(400,'No tiene permiso para acceder');
        
    }

    public function eliminarproducto(Request $request){
        $com=ModeloComentario::where('id_producto',$request->id);
        $com->delete();
        $pro=ModeloProducto::where('id',$request->id);
        $pro->delete();
    }

    public function modificarproducto(Request $request){
        $pro=ModeloProducto::find($request->$id);
        $pro->update(['nombre_producto'=>$request->nombre_producto]);
        if($pro->save()){
            return response()->json('Producto modificado',200);
        }
        return response()->json('Producto no midificado...',400);
    }

    public function mostrarproducto($id=null){
        $pro=ModeloProducto::all();
        if($id){
            return response()->json(['producto',$pro->find($id)]);
        }
        return response()->json(['productos',$pro]);
    }
}
