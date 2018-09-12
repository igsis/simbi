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
        $equipamento = Equipamento::findOrFail($request->route('equipamento'));

        if ($equipamento->portaria == 1) {
            return redirect()->route('frequencia.portaria.cadastroCompleto', $equipamento->id);
        }

        return $next($request);
    }
}
