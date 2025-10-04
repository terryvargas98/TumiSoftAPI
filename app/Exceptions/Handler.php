<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
        }
        if ($request->is('api/*')) {

            // 🔹 401 No autenticado
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'error' => true,
                    'message' => 'No autenticado. Token inválido o ausente.'
                ], 401);
            }

            // 🔹 403 Prohibido (sin permisos)
            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json([
                    'error' => true,
                    'message' => 'No tienes permisos para acceder a este recurso.'
                ], 403);
            }

            // 🔹 404 No encontrado
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json([
                    'error' => true,
                    'message' => 'Recurso no encontrado'
                ], 404);
            }

            // 🔹 422 Validaciones
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'error' => true,
                    'message' => 'Error de validación',
                    'errors' => $exception->errors()
                ], 422);
            }

            // 🔹 500 Error genérico
            return response()->json([
                'error' => true,
                'message' => 'Error interno del servidor',
                'errors' => $exception->getMessage()
            ], 500);
        }

        return parent::render($request, $exception);
    }
    
}
