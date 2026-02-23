<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
{
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    if ($user->role === 'waiting') {
        return redirect('/waiting');
    }

    if (!in_array($user->role, $roles)) {
        abort(403, 'Unauthorized access.');
    }

    return $next($request);
}

}
