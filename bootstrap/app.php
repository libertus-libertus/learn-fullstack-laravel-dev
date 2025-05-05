<?php

use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\EnsureTokenIsValid2;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // menambahkan middleware secara global
        // $middleware->append(EnsureTokenIsValid::class);

        // membuat alias middleware
        $middleware->alias([
            "tokenvalid" => EnsureTokenIsValid::class,
            "tokenvalid2" => EnsureTokenIsValid2::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
