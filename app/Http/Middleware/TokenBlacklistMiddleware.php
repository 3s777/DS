<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenBlacklistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = request()?->bearerToken();

        if ($token && cache()->has('blacklist_token_' . $token)) {
            throw new AuthenticationException(
                'Unauthenticated.',
                ['jwt']
            );
        }



        return $next($request);
    }
}
