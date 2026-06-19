<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {

            if ($exception instanceof ValidationException) {
                return ApiResponse::error(
                    'Validation error',
                    422,
                    $exception->errors()
                );
            }

            if ($exception instanceof AuthenticationException) {
                return ApiResponse::error('Unauthenticated', 401);
            }

            if ($exception instanceof UnauthorizedException) {
                return ApiResponse::error('Forbidden', 403);
            }

            if ($exception instanceof NotFoundHttpException) {
                return ApiResponse::error('Not found', 404);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return ApiResponse::error('Method not allowed', 405);
            }

            return ApiResponse::error(
                config('app.debug') ? $exception->getMessage() : 'Server Error',
                500
            );
        }

        return parent::render($request, $exception);
    }
}