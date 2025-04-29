<?php

namespace App\Exceptions;

use Domain\Auth\Exceptions\JWTExpiredException;
use Domain\Auth\Exceptions\JWTParserException;
use Domain\Auth\Exceptions\JWTValidatorException;
use Domain\Auth\Exceptions\UserCreateEditException;
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->reportable(function (UserCreateEditException $e) {
            // ...
        });

        $this->renderable(function (JWTExpiredException $e) {
            return response()->json([
                'errors' => [],
            ], 401);
        });

        $this->renderable(function (JWTValidatorException $e) {
            return response()->json([
                'errors' => [],
            ], 401);
        });

        $this->renderable(function (JWTParserException $e) {
            return response()->json([
                'errors' => [],
            ], 401);
        });
    }
}
