<?php

namespace App\Http\Middleware;

use App\Http\Resources\ApiResource;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Mockery\Exception;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->authenticate($request, $guards) instanceof AuthenticationException)
            return ApiResource::make(null, 'Token invalido', false, 401);
        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return null;
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        return $this->unauthenticated($request, $guards);
    }

    protected function unauthenticated($request, array $guards)
    {
        return new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request));
    }

}
