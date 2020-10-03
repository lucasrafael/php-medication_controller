<?php

namespace App\Http\Controllers;

use App\Http\Util\Useful;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Util\OrmUtil;

use App\Models\Usuario;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 * @author lucasrafael
 */
class UsuarioController extends Controller
{
    /**
     * Valida os dados informados do usuário.
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validarUsuario($request)
    {
        $validate = Validator::make($request->all(), [
            "nome" => "required|min:5",
            "email" => "required|email",
            "login" => "required|min:5",
            "password" => "required|min:6",
            "password_confirm" => "same:password"
        ]);
        return $validate;
    }

    /**
     * Exibe tela de cadastro de novo usuário.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Persiste os dados do novo usuário informado.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validarUsuario($request);
        if ($validator->fails()) {
            return self::getRedirectResponseWithErrors($validator->errors());
        }
        return OrmUtil::execTrans(function () use ($request) {
            $dados = $request->all();
            $dados['password'] = Hash::make($dados['password']);

            Auth::login(Usuario::create($dados));

        }, 'Usuário registrado', 'controller.index');
    }

    /**
     * Exibe tela de "login".
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('usuarios.login');
    }

    /**
     * Inicia a sessão do usuário.
     * <p>Caso os dados informados sejam válidos, redereciona para a tela principal.</p>
     * <p>Se não for, retorna para a tela de login.</p>
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logar(Request $request)
    {
        $validator = Validator::make($request->all(), ["login" => "required", "password" => "required"]);
        if ($validator->fails()) {
            return self::getRedirectResponseWithErrors($validator->errors());
        }
        try {
            $dados = $request->all();

            $login = $dados['login'];
            $password = $dados['password'];

            $usuario = Usuario::where('login', $login)->first();

            if (Auth::check() || ($usuario && Hash::check($password, $usuario->password))) {
                Auth::login($usuario);

                return redirect(route('controller.index'));
            } else {
                Useful::setMsgErro('Usuário ou Senha inválido!');

                return redirect(route('usuario.login'));
            }
        } catch (\Throwable $e) {
            return self::getRedirectResponseWithErrors($e->getMessage());
        }
    }

    /**
     * Encerra a sessão do usuário.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('usuario.login'));
    }

}
