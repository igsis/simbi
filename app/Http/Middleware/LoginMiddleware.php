<?php

namespace Simbi\Http\Middleware;

use Closure;
use Auth;

class LoginMiddleware
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
        if (auth()->user()->pergunta_seguranca_id == null) {
            return redirect('seguranca')->with('flash_message', 'Bem Vindo! Cadastre sua pergunta e resposta de segurança para acessar o sistema!');
        }
        return $next($request);
    }
}
