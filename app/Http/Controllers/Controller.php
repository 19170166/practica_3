<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
        if($usuario->save()){
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

    public function logout(){
        return response()->json(['Token afectados'=>$request->user()->tokens()->delete()],200);
    }
    
    public function vertoken(Request $request){
        $usuario=ModeloUsuario::where('correo',$request->correo)->first();
        return response()->json([$usuario->tokens[0]->abilities],200);
    }

    public function modificarpermiso(Request $request){
        $usu=ModeloUsuario::where('correo',$request->correo)->first();
        if($usu->tokens[0]->abilities[0]=='admin'){
            $token=ModeloToken::where('name',$request->correo_usuario)->first();
            $per=ModeloUsuario::where('correo',$request->correo_usuario)->first();
            //$token->update(['abilities'=>'["'.$request->permiso.'"]']);
            $token->update(['abilities'=>$request->permiso]);
            $per->update(['rol'=>$request->rol]);
            if($token->save()&&$per->save()){
                return response()->json('permiso modificado');
            }
        }
        return response()->json(['No tiene permiso...',400]);
    }
}
