<?php

namespace Simbi\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Simbi\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::middleware('web')
              ->namespace($this->namespace)
              ->group(base_path('routes/equipamento.php'));

        Route::middleware('web')
              ->namespace($this->namespace)
              ->group(base_path('routes/frequencia.php'));

        Route::middleware('web')
              ->namespace($this->namespace)
              ->group(base_path('routes/user.php'));

       Route::middleware('web')
              ->namespace($this->namespace)
              ->group(base_path('routes/gerenciar.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/funcionario.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/evento.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/acervo.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
