<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\Localization;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            Localization::class,
            HandleInertiaRequests::class,// have to be last one
        ]);
        $middleware->validateCsrfTokens(except: [
            '/logout',  
            '/realtor/listing/*'          
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
