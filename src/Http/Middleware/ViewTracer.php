<?php

namespace AriAbid\LaravelViewTracer\Http\Middleware;

use Closure;
use AriAbid\LaravelViewTracer\LaravelViewTracer;

class ViewTracer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(env('TRACE_VIEWS') && env('TRACE_VIEWS') == true ) {
            $response = $next($request);

            $content = $response->content();

            $response->setContent(LaravelViewTracer::loadStylesToResponse($content));

            return $response;
        } else {
            return $next($request);
        }
    }
}
