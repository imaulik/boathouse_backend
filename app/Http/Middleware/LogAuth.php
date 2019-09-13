<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Session;
use JWTAuth;

class LogAuth
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $headers = $request->headers->all();
        if (isset($headers['key'][0]) && $headers['key'][0] == '$2y$10$aROSSAxEG7RgVYPL.f7VWOxWKIcly0ekxrNwc')
        {
            return $next($request);
        }
        return response()->json(['code' => 500, 'message' => 'Api authentication failed!'], 200);
    }

}
