<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModeloUsuario;

class ControladorMail extends Controller
{
    public function correoprueba(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo);
        
    }
}
