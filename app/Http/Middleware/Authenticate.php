<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle unauthenticated user.
     */
    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
     
        return redirect()->guest(route('login'));
    }

    /**
     * Handle an incoming request and ensure authentication.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }
}
