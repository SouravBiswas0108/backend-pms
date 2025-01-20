<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo(Request $request)
    {
        // For API requests, return null as no redirection is required
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle unauthenticated users.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards)
    {
        // Return a JSON response when unauthenticated
        abort(response()->json([
            'message' => 'Token does not match or is invalid',
            'status' => 401,
        ], 401));
    }

    /**
     * Handle an incoming request and ensure authentication.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            // Authenticate the user using the provided guards
            $this->authenticate($request, $guards);
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            // Handle unauthenticated case
            return $this->unauthenticated($request, $guards);
        }

        // Proceed with the request if authentication is successful
        return $next($request);
    }
}
