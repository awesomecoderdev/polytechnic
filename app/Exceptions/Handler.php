<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response as HTTP;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    /**
     * Default status code for CSRF.
     */
    const HTTP_CSRF_MISMATCH = 419;

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
        $this->reportable(function (Throwable $e) {
            //
            // throw $e;
        });
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        // if (Str::startsWith($request->path(), 'api')) {

        // Not FoundHttp Exception
        // if ($e instanceof ModelNotFoundException || $e instanceof RouteNotFoundException || $e instanceof NotFoundHttpException) {
        //     return Response::json([
        //         'success'   => false,
        //         'status'    => HTTP::HTTP_NOT_FOUND,
        //         'message'   =>  "Not Found.",
        //         'err'   => $e->getMessage(),
        //     ], HTTP::HTTP_NOT_FOUND);
        // }

        // if ($e instanceof TokenMismatchException) {
        //     return Response::json([
        //         'success'   => false,
        //         'status'    => self::HTTP_CSRF_MISMATCH,
        //         'message'   =>  "CSRF Token Mismatch.",
        //     ], self::HTTP_CSRF_MISMATCH);
        // }

        // //  default exception
        // $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : HTTP::HTTP_INTERNAL_SERVER_ERROR;
        // // $status = HTTP::HTTP_NOT_FOUND;
        // return Response::json([
        //     'success'   => false,
        //     'status'    => $status,
        //     'message'   => $e->getMessage(),
        // ], $status); // HTTP::HTTP_OK
        // // }

            // Save the e to an HTML file
            $htmleMessage = $this->converteToHtml($e);
            file_put_contents(public_path('error.html'), $htmleMessage);

            // You can also log the e using Laravel's built-in logging system
            Log::error($e);

        return parent::render($request, $e);
    }

    function converteToHtml($exception)
    {
        $html = '<html>';
        $html .= '<head>';
        $html .= '<title>Exception</title>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>Exception Details</h1>';
        $html .= '<p><strong>Type:</strong> ' . get_class($exception) . '</p>';
        $html .= '<p><strong>Message:</strong> ' . $exception->getMessage() . '</p>';
        $html .= '<p><strong>Code:</strong> ' . $exception->getCode() . '</p>';
        $html .= '<p><strong>File:</strong> ' . $exception->getFile() . '</p>';
        $html .= '<p><strong>Line:</strong> ' . $exception->getLine() . '</p>';
        $html .= '<h2>Stack Trace</h2>';
        $html .= '<pre>' . htmlspecialchars($exception->getTraceAsString()) . '</pre>';
        $html .= '</body>';
        $html .= '</html>';

        return new HtmlString($html);
    }
}
