<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // then: function () {
        //     Route::middleware('api')
        //         ->prefix('api/v1')
        //         ->group(base_path('routes/api_v1.php'));
        // },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        // $middleware->validateCsrfTokens(except: [
        //     '/login',
        // ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => [
                        'message'       => 'Record not found.',
                        'type'              => 'NotFoundHttpException',
                        'code'             => '4405',
                        'link'               => 'Example.com/link',
                        'status_code'  => (string) $e->getStatusCode(),
                    ],
                ], 404);
            }
        });
    })->create();