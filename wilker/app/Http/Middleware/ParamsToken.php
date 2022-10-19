<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ParamsToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $paramsToken = request('token');
        $token = PersonalAccessToken::findToken($paramsToken);

        if ( $token == NULL ){
            return response([
                'message' => 'Unauthorized user'
            ],400);
        }

        if ( $token->tokenable->username != auth()->user()->username ){
            return response([
                'message' => 'Invalid token'
            ],403);
        }

        return $next($request);
    }
}
