<?php

namespace idempotency;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/idempotency.php',
            'idempotency'
        );
    }

    /**
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->publishes(
            [
                __DIR__.'/config/idempotency.php' => config_path('idempotency.php'),
            ]
        );


        $router->aliasMiddleware('idempotent', IdempotencyMiddleware::class);
        $router->pushMiddlewareToGroup('global', IdempotencyMiddleware::class);
    }

}