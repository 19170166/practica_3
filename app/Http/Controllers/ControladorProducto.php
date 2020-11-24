<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloArticulo;
use App\ModeloComentario;
use App\Mail\NotificarAccion;
use App\ModeloUsuario;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificaAgregacion;


class ControladorProducto extends Controller
{
    public function agregarproducto(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        //return response()->json([$usu,$usu->tokens[0]->abilities[0]]);
        if($usu->tokens[0]->abilities[0]=="vendedor"||$usu->tokens[0]->abilities[0]=="admin"){
            $pro=new ModeloArticulo();
            $pro->nombre_articulo=$request->nombre_articulo;
            $pro->id_vendedor=$usu->id;
            if ($pro->save()) {
                Mail::to($usu->correo)->send(new NotificaAgregacion($pro));
                return response()->json(['Producto registrado',$pro],200);
            }
                return response()->json('Producto no registrado...');
        }
        else{
            $mensaje='Agregar un producto';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para esta accion'); 
        }
        
    }

    public function eliminarproducto(Request $request,$id){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=="admin"||$usu->tokens[0]->abilities[0]=="vendedor"){
            $pro=ModeloArticulo::where('id',$id)->first();
            $com=ModeloComentario::where('id_producto',$id);
            if ($com->delete()&&$pro->delete()) {
                return response()->json(['Producto Eliminado',$pro],200);
            }
            elseif($pro->delete()){
                return response()->json(['Producto Eliminado',$pro],200);
            }
            return response()->json(['Error al eliminar el producto...'],400);
        }
        else{
            $mensaje='Eliminar un producto';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para esta accion'); 
        }
    }

    public function modificarproducto(Request $request,$id){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=="vendedor"||$usu->tokens[0]->abilities[0]=="admin"){
            $pro=ModeloArticulo::find($id);
            //return $pro;
            $pro->update(['nombre_articulo'=>$request->nombre_articulo]);
            if($pro->save()){
                return response()->json('Producto modificado',200);
            }
            return response()->json('Producto no midificado...',400);
        }
        else{
            $mensaje='Modificar un producto';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return abort(400,'No tiene permiso para esta accion'); 
        }

    }

    public function mostrarproducto($id=null){
        $pro=ModeloArticulo::all();
        if($id){
            return response()->json(['producto',$pro->find($id)]);
        }
        return response()->json(['productos',$pro]);
    }
}
