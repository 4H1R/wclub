<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class DisableInertiaSSR
{
    public function handle(Request $request, Closure $next): Response
    {
        Config::set('inertia.ssr.enabled', false);

        return $next($request);
    }
}
