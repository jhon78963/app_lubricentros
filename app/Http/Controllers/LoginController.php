<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function validarCredenciales(Request $request)
    {
        request()->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255', 'min:8'],
        ],
        [
            'username.required'=>'Ingrese usuario',
            'username.max'=>'Maximo 20 caracteres para el username del usuario',
            'password.required'=>'Ingrese contraseña ',
            'password.max'=>'Maximo 20 caracteres permitidos',
            'password.min'=>'Mínimo 8 caracteres permitidos',

        ]);

        $usuario = $request->username;
        $respuesta = [];

        $usuario_existente = User::where('username', $usuario)->first();

        if(!empty($usuario_existente)){
            $hashp=$usuario_existente->password;
            $password=$request->get('password');
            if(password_verify($password,$hashp)){
                $respuesta["error"] = false;
                $respuesta["mensaje"] = "Bienvenido al sistema";
                $respuesta["user_name"] = $usuario_existente;

                auth()->loginUsingId($usuario_existente->id);
            }else{
                $respuesta["error"] = true;
                $respuesta["mensaje"] = "Contraseña no valida";
            }
        }else{
            $respuesta["error"] = true;
            $respuesta["mensaje"] = "Usuario no existente";
        }
        return \Response::json($respuesta);
    }

    public function cerrarSesion()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('login.index');
    }
}
