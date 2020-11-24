<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmarRegistro;
use App\Mail\NotificarAccion;
use App\Mail\NotificacionActualizacion;
use Illuminate\Routing\Controller as BaseController;
use App\ModeloUsuario;
use App\ModeloToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function registro(Request $request){
        $request->validate([
            'nombre'=>'required',
            'correo'=>'required|email',
            'password'=>'required'
        ]);
        $usuario=new ModeloUsuario();
        $usuario->nombre=$request->nombre;
        $usuario->correo=$request->correo;
        $usuario->password=Hash::make($request->password);
        $usuario->rol='user';
        $usuario->verificado=false;
        $usuario->url_imagen=null;
        if($usuario->save()){
            Mail::to($usuario->correo)->send(new ConfirmarRegistro($usuario));
            return response()->json($usuario,200);
        }
        return response()->json('error al registrar usuario',400);
    }
    public function login(Request $request){
        $request->validate([
            'correo'=>'required|email',
            'password'=>'required'
        ]);
        $usuario=ModeloUsuario::where('correo',$request->correo)->first();
        //return $usuario;
        if($usuario->verificado==true){
            if(!$usuario||!Hash::check($request->password,$usuario->password)){
                throw ValidationException::withMessages([
                    'correo|password'=>['Datos incorrectos...']
                ]);
            }
                
            if($usuario->rol=='user'){
                $token=$usuario->createToken($request->correo,['user'])->plainTextToken;
                return response()->json(['token de usuario'=>$token],200);
            }
            else if($usuario->rol=='admin'){
                $token=$usuario->createToken($request->correo,['admin'])->plainTextToken;
                return response()->json(['token de admin'=>$token],200);
            }
            else if($usuario->rol=='vendedor'){
                $token=$usuario->createToken($request->correo,['vendedor'])->plainTextToken;
                return response()->json(['token de vendedor'=>$token],200);
            }
        }
        return response()->json(['Error al iniciar sesion, verifique su cuenta primero'],400);
    }

    public function logout(Request $request){
        return response()->json(['Token afectados'=>$request->user()->tokens()->delete()],200);
    }
    
    public function vertoken(Request $request){
        $usuario=ModeloUsuario::where('correo',$request->correo)->first();
        return response()->json([$usuario->tokens[0]->abilities],200);
    }

    public function modificarpermiso(Request $request,$id){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'){
            $token=ModeloToken::where('tokenable_id',$id)->first();
            $per=ModeloUsuario::where('id',$id)->first();
            //$token->update(['abilities'=>'["'.$request->permiso.'"]']);
            //return response()->json($token);
            $token->update(['abilities'=>$request->permiso]);
            $per->update(['rol'=>$request->rol]);
            if($token->save()&&$per->save()){
                Mail::to($per->correo)->send(new NotificacionActualizacion($request->rol));
                return response()->json('permiso modificado');
            }
        }
        
        //1|dor8NZpAaWRM8HjlJBXeZY13rG4izi4gvP3TlEXA
        //2|oikC7d16SWa5LmoCbLL0B1K1Xaav5wYPCgTnDDui
        //3|SyCC0ejWs6NATONjbP6IXuCWVXoGVskuuFAR4dFp
        //4|QDXTUlMXH72VMgJK1xvktN6nioRkDSCzuCAqAZtk
    }
}
