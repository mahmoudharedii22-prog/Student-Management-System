<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\SessionService;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function store(RegisterRequest $request, SessionService $service)
    {
        $user = $service->register($request->validated());

        return response()->json(['success' => 'Registered successfully', 'User' => $user], 201);

    }

    public function login(LoginRequest $request, SessionService $service)
    {
        try {
            $data = $service->login($request->validated());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['success' => 'Logged in successfully', 'user' => $data['user'], 'token' => $data['token']], 200);
    }

    public function logout( SessionService $service)
    {
        if ($service->logout(Auth::user())) {

            return response()->json(['success' => 'Logged out successfully'], 200);
        }

        return response()->json(['errer' => 'try to Logg out again'], 400);
    }
}
