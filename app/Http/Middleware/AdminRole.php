<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
   public function handle($request, Closure $next)
    {
        // Kullanıcı giriş yapmış mı kontrol et
        if (Auth::check()) {
            // Kullanıcının rolü 1 veya 2 ise devam et
            if (in_array(Auth::user()->role, [1, 2])) {
                return $next($request);
            }
        }

        // Kullanıcının rolü 1 veya 2 değilse mod-homepage'e yönlendir
        return redirect()->route('dashboard.mod_homepage' , 'tr');
    }
}
