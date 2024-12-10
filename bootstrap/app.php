<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            dd($e);
            $data = [
                'method' => request()->getMethod(),
                'message' => $e->getMessage(),
                //'user' => auth()->id(),
                'data' => request()->all(),
            ];
    
            if ($e instanceof ValidationException) {
                $data['errors'] = $e->errors();
            }
    
            //Log::channel('daily')->info(json_encode($data, JSON_PRETTY_PRINT));      
        });
    })->create();
