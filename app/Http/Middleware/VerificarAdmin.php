<?php

namespace App\Http\Middleware;
use App\ModeloUsuario;
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
        return abort(400,'No tiene permiso para acceder');

    }
}
