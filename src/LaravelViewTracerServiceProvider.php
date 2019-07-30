<?php

namespace AriAbid\LaravelViewTracer;

use Illuminate\Support\ServiceProvider;
use AriAbid\LaravelViewTracer\LaravelViewTracer;

class LaravelViewTracerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('ENABLE_VIEW_TRACER') && env('ENABLE_VIEW_TRACER') == true ) {
			$this->pushMiddleware();
			$this->bootComposerAndCreator();
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function bootComposerAndCreator()
    {
        LaravelViewTracer::initViewComposerAndCreator();
	}

	public function pushMiddleware()
	{
		$router = $this->app['router'];
		$router->pushMiddlewareToGroup('web', \AriAbid\LaravelViewTracer\Http\Middleware\ViewTracer::class);
	}
}
