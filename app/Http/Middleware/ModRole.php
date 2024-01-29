<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ModRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 3) {
                return $next($request);
            }
        }

        return redirect()->route('dashboard.admin_homepage' , 'tr');

    }
}
