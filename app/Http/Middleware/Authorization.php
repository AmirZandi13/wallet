<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use Closure;
use Illuminate\Http\Request;

class Authorization
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
        $bearerToken = $request->bearerToken();

        if (! \App\ThirdParties\Authorization::checkAuthAccessToken($bearerToken)) {
            throw new UnauthorizedException();
        }

        return $next($request);
    }
}
