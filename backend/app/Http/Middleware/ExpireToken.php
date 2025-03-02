<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExpireToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $token = $request->user()->currentAccessToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $createdAt = Carbon::parse($token->created_at);
        $expiredTime = $createdAt->copy()->addHour();

        if (Carbon::now()->greaterThan($expiredTime)) {
            $token->delete();
            return response()->json([
                'message' => 'Token Expired',
            ], 401);
        }

        return $next($request);
    }
}
