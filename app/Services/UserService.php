<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']); // Hash password before saving

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'wallet_balance' => 0,
            'status' => 'active',
            'kyc_status' => 'pending'
        ]);
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser($id, $data)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return false; // User not found
        }
        $user->delete();
        return true; // User deleted successfully
    }

    public function suspendUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $user->status = 'suspended';
        $user->save();
        return $user;
    }

    public function activateUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $user->status = 'active';
        $user->save();
        return $user;
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $newPassword = 'password123';
        $user->password = Hash::make($newPassword);
        $user->save();
        return ['user' => $user, 'new_password' => $newPassword];
    }

    public function updatePassword($id, $newPassword)
    {
        $user = User::find($id);
        if (!$user) {
            return null; // User not found
        }

        // Hash the new password
        $user->password = Hash::make($newPassword);
        $user->save();

        return $user;
    }

    public function approveKYC($id)
    {
        return $this->updateKYCStatus($id, 'approved');
    }

    public function rejectKYC($id)
    {
        return $this->updateKYCStatus($id, 'rejected');
    }

    private function updateKYCStatus($id, $status)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $user->kyc_status = $status;
        $user->save();
        return $user;
    }

    public function fundWallet($id, $amount)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $user->wallet_balance += $amount;
        $user->save();
        return $user;
    }

    public function deductWallet($id, $amount)
    {
        $user = User::find($id);
        if (!$user || $user->wallet_balance < $amount) {
            return null;
        }
        $user->wallet_balance -= $amount;
        $user->save();
        return $user;
    }
}
