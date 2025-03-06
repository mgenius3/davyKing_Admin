<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->getAllUsers(), 200);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return $user ? response()->json($user, 200) : response()->json(['message' => 'User not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->only(['name', 'email', 'phone']));
        return $user ? response()->json(['message' => 'User updated successfully', 'user' => $user], 200)
            : response()->json(['message' => 'User not found'], 404);
    }


    public function destroy($id)
    {
        $deleted = $this->userService->deleteUser($id);
        return $deleted
            ? response()->json(['message' => 'User deleted successfully'], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function suspendUser($id)
    {
        $user = $this->userService->suspendUser($id);
        return $user ? response()->json(['message' => 'User suspended successfully'], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function activateUser($id)
    {
        $user = $this->userService->activateUser($id);
        return $user ? response()->json(['message' => 'User activated successfully'], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function resetPassword($id)
    {
        $result = $this->userService->resetPassword($id);
        return $result ? response()->json(['message' => 'Password reset successfully', 'new_password' => $result['new_password']], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function approveKYC($id)
    {
        $user = $this->userService->approveKYC($id);
        return $user ? response()->json(['message' => 'KYC approved successfully'], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function rejectKYC($id)
    {
        $user = $this->userService->rejectKYC($id);
        return $user ? response()->json(['message' => 'KYC rejected successfully'], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function fundWallet(Request $request, $id)
    {
        $user = $this->userService->fundWallet($id, $request->amount);
        return $user ? response()->json(['message' => 'Wallet funded successfully', 'new_balance' => $user->wallet_balance], 200)
            : response()->json(['message' => 'User not found'], 404);
    }

    public function deductWallet(Request $request, $id)
    {
        $user = $this->userService->deductWallet($id, $request->amount);
        return $user ? response()->json(['message' => 'Amount deducted successfully', 'new_balance' => $user->wallet_balance], 200)
            : response()->json(['message' => 'Insufficient balance or user not found'], 400);
    }

    public function updateUserPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
        ]);
    
        $userService = new UserService();
        $user = $userService->updatePassword($id, $request->new_password);
    
        if ($user) {
            return response()->json(['message' => 'Password updated successfully', 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}