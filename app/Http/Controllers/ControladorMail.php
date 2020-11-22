<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloUsuario;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmarRegistro;
use Illuminate\Support\Facades\DB;

class ControladorMail extends Controller
{
    public function correoprueba(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        //return $usu;
        $email=Mail::to('19170166@uttcampus.edu.mx')->send(new ConfirmarRegistro($usu));
        //return response()->json(["correo"=>$correo],200);
    }

    public function verificarusuario(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        return response()->json([$usu]);
        $usu->update(['verificado'=>true],200);
        $usu->save();
        
    }
}
