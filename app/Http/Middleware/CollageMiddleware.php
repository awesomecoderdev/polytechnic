<?php

namespace App\Http\Middleware;

use App\Models\Collage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HTTP;
use Illuminate\Support\Facades\Response;


class CollageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (Illuminate\Support\Facades\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // check collage exist
        try {
            $collage = Collage::findOrFail($request->collage);
            $request->collage = $collage;
        } catch (\Throwable $th) {
            // throw $th;
            return Response::json([
                'success'   => false,
                'status'    => HTTP::HTTP_UNAUTHORIZED,
                'message'   => "Unauthorized Access.",
            ], HTTP::HTTP_UNAUTHORIZED); // HTTP::HTTP_OK
        }

        // response
        return $next($request);
    }
}
