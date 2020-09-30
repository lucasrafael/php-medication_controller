<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    protected function validarUsuario($request)
    {
        $validatedUsr = Validator::make($request->all(), [
            "nome" => "required | min:5",
            "email" => "required | email",
            "login" => "required | min:5",
            "password" => "required | min:6",
            "password_confirm" => "same:password"
        ]);
        return $validatedUsr;
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validarUsuario($request);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        return self::execTrans(function () use ($request){
            $dados = $request->all();
            $dados['password'] = Hash::make($dados['password']);

            $usuario = Usuario::create($dados);

            Auth::login($usuario);

        },'Usuário registrado', 'controller.index');
    }

    public function login()
    {
        return view('usuarios.login');
    }

    public function logar(Request $request)
    {
        $validator = Validator::make($request->all(), ["login" => "required", "password" => "required" ]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        try {
            $dados = $request->all();

            $login = $dados['login'];
            $password = $dados['password'];

            $usuario = Usuario::where('login', $login)->first();

            if (Auth::check() || ($usuario && Hash::check($password, $usuario->password))){
                Auth::login($usuario);

                return redirect(route('controller.index'));
            } else {
                self::setMsgErro('Usuário ou Senha inválido!');

                return redirect(route('usuario.login'));
            }
        }
        catch (\Throwable $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('usuario.login'));
    }

}
