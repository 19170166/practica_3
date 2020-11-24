<?php

namespace App\Http\Middleware;
use App\ModeloUsuario;
use Closure;

class VerificarUsuario
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
        if($usu->verificado==true){
            return $next($request);
        }
        return abort(400,'no ha verificado su correo');
    }
}
