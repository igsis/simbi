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
        $idPergunta =  Auth::user()->idPerguntaSeguranca;
        if (!($idPergunta))
        {
            return view('auth.pergunta_resposta');
        }
        return $next($request);
    }
}
