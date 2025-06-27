<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Verifica que el usuario autenticado tenga alguno de los roles permitidos.
     *
     * Se usa así: ->middleware('role:admin,cajero,usuario')
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $allowed = collect(explode(',', $roles))->map(fn($r) => trim($r));

        if (! $allowed->contains($user->role)) {
            abort(403);
        }

        return $next($request);
    }
}
