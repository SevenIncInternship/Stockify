<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'AKSES DITOLAK: PERAN PENGGUNA TIDAK DITEMUKAN.');
        }

        return $next($request);
    }
}
