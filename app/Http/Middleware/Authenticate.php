<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Request;
use Exception;
use Closure;

class Authenticate extends Middleware
{

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    public function handle($request, Closure $next, ...$guards ) {
        if ($token = $request->cookie('authToken')) {
            $request->headers->set('Authorization', 'Bearer '.$token);
        }
        $this->authenticate($request,$guards);
        return $next($request);
    }

}
