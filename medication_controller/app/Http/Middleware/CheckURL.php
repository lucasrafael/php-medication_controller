<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

/**
 * Class CheckURL
 * @package App\Http\Middleware
 * @author lucasrafael
 */
class CheckURL
{
    /**
     * Manipula com as "request" de entrada.
     * <p>Caso o usuário não esteja com sessão ativa, ele será redirecionado para a tela principal
     * se tentar acessar alguma "URL" que contenha: "\create"; "\store"; "\update"; "\destroy"; "\edit"; "\remove".</p>
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && preg_match("/^.*\/(create|store|update|destroy|edit|remove).*$/", $request->url())) {
            return redirect()->route('controller.index');
        }
        return $next($request);
    }

}
