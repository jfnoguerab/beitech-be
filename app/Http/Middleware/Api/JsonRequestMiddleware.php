<?php

namespace App\Http\Middleware\Api;

use Closure;

class JsonRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isJson()) {
            return $next($request);
        }else{
            $response = [
                'status'  =>'error',
                'message' => 'Only JSON requests are accepted',
                'data'    => null,
            ];
            return response()->json($response, 401);
        }

    }
}
