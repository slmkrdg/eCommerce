<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $e) { 

            return response()->json([
                'status'  => '0',  
                'message' => $e->getMessage()
            ],match (true) {
                $e instanceof ThrottleRequestsException => 429,
                $e instanceof NotFoundHttpException => 404, 
                $e instanceof QueryException => 500, 
                $e instanceof AuthenticationException => 401, 
                $e instanceof ValidationException => 422, 
                $e instanceof AccessDeniedHttpException || $e instanceof AuthorizationException => 403, 
                $e instanceof DecryptException => 400, 
                default => 500, 
            });
    
        });
    })->create();
