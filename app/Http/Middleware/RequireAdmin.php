<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RequireAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->is_admin)
            return $next($request);
        else
            abort(403);
    }
}
