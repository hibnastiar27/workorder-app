<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expired_at' => Carbon::now()->addHour()->toDateTimeString(),
        ], 'Register Success');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expired_at' => Carbon::now()->addHour()->toDateTimeString(),
        ], 'Login Success');
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse([], 'Logout Success');
    }
}
