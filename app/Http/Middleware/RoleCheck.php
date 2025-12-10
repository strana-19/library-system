<?php

namespace App\Http\Middleware;

use Closure;

class RoleCheck
{
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('logged_in')) {
            return redirect('/')->withErrors(['login' => 'Session expired. Please log in again.']);
        }

        if (session('role') !== $role) {
            return redirect('/')->withErrors(['access' => 'Access denied.']);
        }

        return $next($request);
    }
}
