<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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

        // $this->renderable(function (\Exception $e) {
        //     if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
        //         return redirect()->route('login');
        //     };
        // });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ErrorException) {
            // Check for the error message indicating an undefined variable or array
            if ($request->is('print')) {
                //     $errorMessage = $exception->getMessage();
                //     if (strpos($errorMessage, 'Undefined variable') !== false || strpos($errorMessage, 'Undefined offset') !== false || strpos($errorMessage, 'Undefined array') !== false) {
                // Return a custom error view for undefined variables or arrays
                $coordinates = $request->input('coordinates_print');
                return response()->view('errors.undefined', compact('coordinates'), 500);
                //     }
            }
        }

        if ($exception instanceof QueryException) {
            $message = $exception->getMessage();
            return response()->view('errors.queryException', compact('message'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        }

        return parent::render($request, $exception);
    }
}
