<?php

namespace Simbi\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Simbi\User;

class FuncMiddleware
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
        $user = User::all()->count();
        if (!($user == 1))
        {
            if (!Auth::user()->hasPermissionTo('Funcionario'))
            {
                abort('401');
            }
        }

        return $next($request);
    }
}
