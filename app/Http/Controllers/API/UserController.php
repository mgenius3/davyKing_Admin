<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; // Import the base Controller class

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Get all users (Admin only)
    public function index()
    {
        Log::info('Fetching all users', ['count' => User::count()]); // Logs the total users count
        return response()->json(User::all(), 200);
    }

    // Get single user details
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        return response()->json($user, 200);
    }

    // Admin can update user details
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->update($request->only(['name', 'email', 'phone']));
        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    // Ban user (Admin only)
    public function banUser($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->status = 'banned';
        $user->save();
        return response()->json(['message' => 'User banned successfully'], 200);
    }

    // Unban user (Admin only)
    public function unbanUser($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->status = 'active';
        $user->save();
        return response()->json(['message' => 'User unbanned successfully'], 200);
    }

    // Reset user password (Admin only)
    public function resetPassword(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $newPassword = 'Default@123';
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json(['message' => 'Password reset successfully', 'new_password' => $newPassword], 200);
    }

    // Approve KYC (Admin only)
    public function approveKYC($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->kyc_status = 'approved';
        $user->save();

        return response()->json(['message' => 'KYC approved successfully'], 200);
    }

    // Reject KYC (Admin only)
    public function rejectKYC($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->kyc_status = 'rejected';
        $user->save();

        return response()->json(['message' => 'KYC rejected successfully'], 200);
    }

    // Manually fund wallet (Admin only)
    public function fundWallet(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $amount = $request->amount;
        $user->wallet_balance += $amount;
        $user->save();

        return response()->json(['message' => 'Wallet funded successfully', 'new_balance' => $user->wallet_balance], 200);
    }

    // Deduct from wallet (Admin only)
    public function deductWallet(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $amount = $request->amount;
        if ($user->wallet_balance < $amount) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        $user->wallet_balance -= $amount;
        $user->save();

        return response()->json(['message' => 'Amount deducted successfully', 'new_balance' => $user->wallet_balance], 200);
    }

    // Admin can update any user's profile by ID
    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id); // Find user by ID
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->only(['name', 'email', 'phone']));
        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }
}
