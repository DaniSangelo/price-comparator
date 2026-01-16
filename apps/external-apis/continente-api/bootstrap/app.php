<?php

use App\Exceptions\UnauthorizedException;
use App\Infra\Http\Middleware\SetHostMiddleware;
use App\Infra\Http\Middleware\SetRequestIdMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/'.env('API_VERSION', 'v1'),
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SetHostMiddleware::class);
        $middleware->append(SetRequestIdMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e) {
            if ($e instanceof UnauthorizedException) {
                logger()->error($e->getMessage());
                return response()->json([], $e->getCode());
            }
        });
    })->create();
