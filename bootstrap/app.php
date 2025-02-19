<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (\Symfony\Component\HttpFoundation\Response $response) {
            if ($response->getStatusCode() == 500 && !env('APP_DEBUG')) {
                return response()->error('Internal Server Error');
            }
            return $response;
        });

        $exceptions->renderable(function (\App\Exceptions\ModelNotFound $exception) {
            return response()->error($exception->getMessage(), \Illuminate\Http\Response::HTTP_NOT_FOUND);
        });

        $exceptions->reportable(function (Throwable $exception) {
            \Illuminate\Support\Facades\Log::error($exception->getMessage());
        });
    })->create();
