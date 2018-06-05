<?php

namespace Simbi\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Simbi\Models\User;

class CoordMiddleware
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
        $id = Auth::user()->id;
        $user = User::all()->count();
        if (!($user == 1))
        {
            if ($request->is("usuarios/$id/editar"))
            {
                if (Auth::user()->hasPermissionTo('Funcionario'))
                {
                    return $next($request); 
                }
                else
                {
                    abort('401');
                }
            }

            if ($request->is("usuarios/$id"))
            {
                if (Auth::user()->hasPermissionTo('Funcionario'))
                {
                    return $next($request); 
                }
                else
                {
                    abort('401');
                }
            }
            
            if (!Auth::user()->hasPermissionTo('Coordenador')) //If user does //not have this permission
            {
                abort('401');
            }

        }
        return $next($request);
    }
}
