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
        if(env('TRACE_VIEWS') && env('TRACE_VIEWS') == true ) {
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
}
