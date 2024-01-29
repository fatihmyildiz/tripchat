<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role != 1) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
