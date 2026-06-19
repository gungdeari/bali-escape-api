<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // validation
        $fields = $request->validated();

        // create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $user->assignRole('user');

        $user->load('roles');
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Register success',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        // validation
        $fields = $request->validated();

        // find user
        $user = User::where('email', $fields['email'])->first();

        // invalid
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials']
            ]);
        }

        $user->load('roles');
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => [
                'token' => $token,
                'user' => new UserResource($user)
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // delete current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout success'
        ]);
    }

    public function user(Request $request)
    {
        $user = $request->user()->load('roles');

        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data'    => new UserResource($user),
        ]);
    }
}