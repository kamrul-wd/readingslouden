<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws AccessDeniedHttpException
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()->containsRoles(['admin','master']) && env('APP_ENV') !== 'testing') {
            if ($request->ajax()) {
                return response('Forbidden.', 403);
            } else {
                return abort(403);
            }
        }

        return $next($request);
    }
}
