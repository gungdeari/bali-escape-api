<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (!$user || !$user->role) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($user->role->name !== $role) {
            return response()->json([
                'message' => 'Forbidden - insufficient role'
            ], 403);
        }

        return $next($request);
    }
}
