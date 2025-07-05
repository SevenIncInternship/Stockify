<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectRoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'manajer':
                return redirect()->route('manajer.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
                abort(403, 'Peran pengguna tidak dikenal atau tidak memiliki akses dashboard.');
        }
    }
}
