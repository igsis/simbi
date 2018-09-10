<?php

namespace Simbi\Http\Middleware;

use Closure;
use Simbi\Models\Equipamento;

class FormularioMiddleware
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
            return redirect('frequencia.portaria.cadastroCompleto');
        }
        return $next($request);
    }
}
