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
        if (Auth::attempt(['name' => $request->name, 'password => $request']))
        {
            return $next($request);

        }
        return view('auth.pergunta_resposta');
    }
}
