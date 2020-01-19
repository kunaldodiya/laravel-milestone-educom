<?php

namespace App\Http\Middleware;

use Closure;

class Reseller
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
        if ($request->header('Authorization')) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Not a valid Reseller account.',
        ]);
    }
}
