<?php

namespace App\Http\Middleware;
use App\ModeloUsuario;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificarAccion;
use Closure;

class VerificarAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'){
            return $next($request);
        }
        else{
            $mensaje='Modificar un permiso';
            Mail::to('19170166@uttcampus.edu.mx')->send(new NotificarAccion($usu,$mensaje));
            return response()->json(['No tiene permiso para acceder...'],400);
        }

    }
}
