<?php

namespace App\Http\Controllers;

/*Agregamos el modelo de User 
el facade para encriptar password
el facade para validar
el facade de JWTAuth
el de exception para lanzar errores de JWT
*/
use App\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    //Verifica la autenticación y en caso de pasar todas la validaciones
    //retorna el token.
    public function authenticate(Request $request){
        //Con only especificamos que campos del request queremos obtener
        $credentials = $request->only('email', 'password');
        try {
            if(!$token = JWTAuth::attempt($credentials)){ //Valida si el attempt de login retorna un error en base a credenciales
                return response()->json(['error' => 'Credenciales inválidas'], 400 );
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No podemos crear el token, algo anda mal'], 500); //Errores de servidor se marcan con status 500
        }

        return response()->json(compact('token'));  //compact('token') = ['token' => $token]; 
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            //Reglas de validación
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', //unique:users quiere decir que ese email no exista en otro usuario (evitar usuarios duplicados)
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        //Ya pasamos las validaciones, procedemos a crear el usuario.
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        $token = JWTAuth::fromUser($user); //Generamos un token en base al usuario creado

        return response()->json(['user' => $user, 'token' => $token], 201) //status 201 indica recurso creado

    }


    public function getAuthenticatedUser(){
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){ //Valida si es que el token enviado tiene algún usuario
                return response()->json(['Usuario no encontrado'], 404) //status 404 recurso no encontrado
            } 
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['Token expirado'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json(['Token inválido'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e){
            return response()->json(['No se ha enviado un token'], $e->getStatusCode());
        }

        return response()->json(['user' => $user]); 
    }




/*
    $valor = 5; 
    $arreglo = ['valor' => $valor]; 
    $arregloAux = compact('valor'); //Va a generar lo mimos que tiene $arreglo
*/
    
}
