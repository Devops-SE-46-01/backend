<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Api;
use App\Traits\ApiTrait;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    use ApiTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function(Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    public function handleException($request, Exception $e)
    {
        if($request->wantsJson()) {
            if($e instanceof ValidationException)
                return $this->sendResponse($e->errors(), 422);

            if($e instanceof AuthenticationException)
                return $this->sendResponse(['message' => $e->getMessage()], 401);

            if($e instanceof NotFoundHttpException)
                return $this->sendResponse(['message' => 'Your request not found'], 404);
    
            return $this->sendResponse(['message' => $e->getMessage()], 500);
        }
    }
}
