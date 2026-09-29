<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // User must be logged in
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();

        // Check if user's role is allowed
        if (!in_array($user->role, $roles)) {
            abort(403);
        }

        // Faculty accounts must be approved by Admin
        if ($user->role === 'faculty' && $user->status !== 'approved') {
            abort(403, 'Your faculty account is still awaiting approval.');
        }

        return $next($request);
    }
}