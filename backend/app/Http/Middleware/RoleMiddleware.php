<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // $roles = array_map('intval', $roles);

        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized',
                'debug' => 'User not authenticated'
            ], 401);
        }

        $roleId = Auth::user()->role_id;

        if ($roleId != $role) {
            return response()->json([
                'message' => 'Forbiden: Access Denied',
                'user_role' => $roleId,
                'required_role' => $role
            ], 403);
        }

        return $next($request);
    }
}


        // if (!in_array($roleId, $roles)) {
        //     return response()->json([
        //         'message' => 'Forbidden',
        //         'user_role' => $roleId,
        //         'allowed_roles' => $roles
        //     ], 403);
        // }
