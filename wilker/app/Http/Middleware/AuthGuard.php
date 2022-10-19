<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( auth()->user()->role != 'admin'){
            // return $next($request);
            return response([
                'message' => 'Forbidden access'
            ],403);
        }

        return $next($request);
    }
}
