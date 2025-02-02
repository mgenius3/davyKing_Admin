<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminAuthController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Version 1 (v1) of the API
Route::prefix('v1')->group(function () {

    // User authentication routes
    Route::prefix('user')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    // Admin authentication routes
    Route::prefix('admin')->group(function () {
        Route::post('/register', [AdminAuthController::class, 'register']);
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    // USER MANAGEMENT

    
    // Group routes that require authentication
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/users', [UserController::class, 'index']);//->middleware('admin'); // Only admin
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::patch('/users/{id}', [UserController::class, 'update']);//->middleware('admin'); // Only admin
        Route::delete('/users/{id}', [UserController::class, 'destroy']);//->middleware('admin'); // Only admin

        // Actions for Admins only
        Route::patch('/users/{id}/ban', [UserController::class, 'banUser']);//->middleware('admin');
        Route::patch('/users/{id}/unban', [UserController::class, 'unbanUser']);//->middleware('admin');
        Route::patch('/users/{id}/reset-password', [UserController::class, 'resetPassword']);//->middleware('admin');
        Route::patch('/users/{id}/fund-wallet', [UserController::class, 'fundWallet']);//->middleware('admin');
        Route::patch('/users/{id}/deduct-wallet', [UserController::class, 'deductWallet']);//->middleware('admin');
        Route::patch('/users/{id}/approve-kyc', [UserController::class, 'approveKYC']);//->middleware('admin');
        Route::patch('/users/{id}/reject-kyc', [UserController::class, 'rejectKYC']);//->middleware('admin');

        // Users can only update their own profile
        Route::patch('/profile', [UserController::class, 'updateProfile']);
    });

    // Authenticated user and admin routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user-profile', function (Request $request) {
            return $request->user(); // Authenticated user
        });

        Route::get('/admin-dashboard', function (Request $request) {
            // Ensure only admins can access this
            if (!$request->user()->tokenCan('admin')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            return response()->json(['message' => 'Welcome to Admin Dashboard']);
        });
    });

    // Public route
    Route::get('/hello', function () {
        return response()->json(['message' => 'Hello World']);
    });
});