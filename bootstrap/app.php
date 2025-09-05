<?php

use App\Enums\Logger\SiemLogIdEnum;
use App\Services\SiemLoggerService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\DisableInertiaSSR::class,
        ]);

        $middleware->trustProxies(at: '172.18.0.0/16, 185.8.173.0/28, 195.248.241.160/28, 95.211.240.112/28, 95.211.219.96/28, 130.185.74.48/28, 46.20.41.224/28, 185.8.174.144/28, 95.211.250.112/28, 185.208.175.144/28, 95.211.188.240/28, 45.77.211.240/28, 178.22.120.192/28, 45.77.211.208/28, 45.77.223.80/28, 199.247.3.16/28, 95.179.140.112/28, 31.214.248.208/28, 95.179.254.176/28, 195.248.242.192/28, 185.110.191.240/28, 185.8.175.208/28, 130.185.79.128/28, 207.148.69.96/28, 194.5.188.32/28, 95.179.164.96/28, 144.202.78.96/28, 144.202.114.128/28, 155.138.162.96/28, 185.204.197.0/28, 144.202.58.96/28, 158.51.122.240/28, 195.181.174.64/28, 94.182.153.64/28, 171.22.26.240/28, 5.135.72.112/28, 31.214.248.208/28, 45.139.11.240/28, 77.237.66.128/28, 195.88.208.176/28, 95.179.220.128/28, 45.76.132.16/28, 89.36.162.32/28, 64.176.64.80/28, 65.20.113.240/28, 167.179.93.112/28, 139.84.177.16/28, 158.247.223.48/28, 64.176.15.176/28, 139.84.236.0/28, 216.238.117.0/28, 91.228.186.48/28, 213.183.48.16/28, 89.187.169.48/28, 45.32.131.160/28, 84.17.42.224/28, 208.85.22.32/28, 79.175.148.128/28, 5.160.143.64/28', headers: Request::HEADER_X_FORWARDED_FOR);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request) {
            if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
                app(SiemLoggerService::class)->log(SiemLogIdEnum::UserDoesNotHavePermission, 'User does not have permission');
            }

            if (! app()->environment(['local', 'testing']) && ! Str::contains($request->url(), '/admin') && in_array($response->getStatusCode(), [500, 503, 404, 403])) {
                return Inertia::render('Error', ['status' => $response->getStatusCode()])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            }

            return $response;
        });
    })->create();
