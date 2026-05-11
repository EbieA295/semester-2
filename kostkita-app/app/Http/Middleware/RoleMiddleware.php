<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $userRole = $request->user() ? trim($request->user()->role) : 'null';
        if (!$request->user() || $userRole !== $role) {
            abort(403, "Unauthorized action. Expected: $role, Got: $userRole");
        }

        return $next($request);
    }
}
