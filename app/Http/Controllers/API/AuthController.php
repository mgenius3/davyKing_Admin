<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Log::info($request);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'phone' => 'required|string|unique:users,phone',
                'password' => 'required|string|min:6|confirmed',

            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'is_admin' => false, // Default to false (not an admin)
            ]);

            $token = $user->createToken('user_token')->plainTextToken;
            
            $user = User::where('email', $validated['email'])->first();


            return response()->json(['user' => $user, 'token' => $token], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                }
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
