<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        // Guard against environments where the base Handler may not
        // provide the `reportable` helper (older/newer implementations).
        if (method_exists($this, 'reportable')) {
            $this->reportable(function (Throwable $e) {
                //
            });
        }
    }
}
