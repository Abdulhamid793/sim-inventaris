<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // pemakaian di route: middleware('role:admin') atau middleware('role:admin,staff')
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }
        return $next($request);
    }
}