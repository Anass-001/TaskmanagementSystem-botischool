<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if (!in_array($user->is_role, $roles)) {
            return redirect('home')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
