<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class CheckURL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && preg_match("/^.*\/(create|store|update|destroy|edit|remove).*$/", $request->url())) {
             return redirect()->route('controller.index');
        }
        return $next($request);
    }
}
