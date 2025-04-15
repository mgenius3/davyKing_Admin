<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AdController;
use App\Http\Controllers\Api\GiftCardController;
use App\Http\Controllers\Api\TransactionLogController;
use App\Http\Controllers\API\CryptoController;
use App\Http\Controllers\API\BankDetailsController;



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
    // Route::prefix('admin')->group(function () {
    //     Route::post('/register', [AuthController::class, 'register']);
    //     Route::post('/login', [AuthController::class, 'login']);
    //     Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    // });

    // USER MANAGEMENT
    Route::middleware(['auth:sanctum'])->group(function () {
        // Group all user-related routes under 'users' prefix
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->middleware('admin'); // Only admin
            // Route::post('/create', [UserController::class, 'create_user']);
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::patch('/{id}', [UserController::class, 'update']); // Update user
            Route::get('/{id}', [UserController::class, 'show']); // View user details
            Route::patch('/{id}/suspend', [UserController::class, 'suspendUser']);
            Route::patch('/{id}/activate', [UserController::class, 'activateUser']);
            Route::patch('/{id}/update-password', [UserController::class, 'updateUserPassword']);
            Route::patch('/{id}/reset-password', [UserController::class, 'resetPassword']);
            Route::patch('/{id}/fund-wallet', [UserController::class, 'fundWallet'])->middleware('admin');
            Route::patch('/{id}/deduct-wallet', [UserController::class, 'deductWallet']);
            Route::patch('/{id}/approve-kyc', [UserController::class, 'approveKYC']);
            Route::patch('/{id}/reject-kyc', [UserController::class, 'rejectKYC']);
        });
    });

    //ADS
    Route::get('/ads', [AdController::class, 'index'])->name('api.ads.index');

    //GIFTCARD
    Route::middleware(['auth:sanctum'])->group(function () {
        // Gift Card Endpoints
        Route::prefix('gift-cards')->group(function () {
            Route::get('/', [GiftCardController::class, 'index'])->name('api.gift-cards.index');
            Route::get('/{giftCardId}', [GiftCardController::class, 'show'])->name('api.gift-cards.show');

            // Transaction Endpoints
            Route::post('/transactions', [GiftCardController::class, 'storeTransaction'])->name('api.transactions.store');
            Route::get('/transactions/user', [GiftCardController::class, 'userTransactions'])->name('api.transactions.user');
            Route::get('/transactions/{transactionId}', [GiftCardController::class, 'transaction'])->name('api.transactions.show');
            Route::put('/transactions/{transactionId}/status', [GiftCardController::class, 'updateTransactionStatus'])->name('api.transactions.update-status');
        });
    });

    //CRYPTO
    Route::middleware(['auth:sanctum'])->group(
        function () {
            Route::prefix('crypto')->group(function () {
                Route::get('/', [CryptoController::class, 'getCryptocurrencies']);
                Route::post('/transactions', [CryptoController::class, 'storeTransaction']);
                Route::get('/transactions', [CryptoController::class, 'getUserTransactions']);
                Route::get('/transactions/{transactionId}', [CryptoController::class, 'getTransaction']);
            });
        }
    );

    //TRANSACTION LOG
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/transaction-logs', [TransactionLogController::class, 'getTransactionLogs']);
    });

    //ADMIN BANK DETAILS
    Route::get('/bank-details', [BankDetailsController::class, 'index'])->name('api.bank-details.index');


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
