<?php

namespace App\Services;

use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Models\SystemWallet;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;

class CryptoService
{
    public function createCryptoCurrency($data, $userId)
    {
        $crypto = CryptoCurrency::create($data);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'crypto_currency_created',
            'details' => json_encode($data),
            'created_at' => now(),
        ]);

        return $crypto;
    }

    public function updateCryptoCurrency($cryptoId, $data, $userId)
    {
        $crypto = CryptoCurrency::findOrFail($cryptoId);
        $oldData = $crypto->toArray();
        $crypto->update($data);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'crypto_currency_updated',
            'details' => json_encode(['old' => $oldData, 'new' => $data]),
            'created_at' => now(),
        ]);

        return $crypto;
    }
    
    public function createTransaction($data, $userId)
    {
        $crypto = CryptoCurrency::findOrFail($data['crypto_currency_id']);
        $data['fiat_amount'] = $data['type'] === 'buy'
            ? $data['amount'] * $crypto->buy_rate
            : $data['amount'] * $crypto->sell_rate;

        $wallet = SystemWallet::firstOrCreate(
            ['crypto_currency_id' => $data['crypto_currency_id']],
            ['balance' => 0]
        );

        if ($data['type'] === 'sell') {
            if (!isset($data['proof_file']) || !$data['proof_file']) {
                throw new \Exception('Proof of money transfer is required for sell transactions');
            }
            // Store the proof file
            $data['proof_file'] = $data['proof_file']->store('crypto_proofs', 'public');
            $data['wallet_address'] = null; // Not needed for sell
            if ($wallet->balance < $data['amount']) {
                throw new \Exception('Insufficient system liquidity for sell');
            }
            $wallet->decrement('balance', $data['amount']);
        } elseif ($data['type'] === 'buy') {
            if (!isset($data['wallet_address']) || !$data['wallet_address']) {
                throw new \Exception('Wallet address is required for buy transactions');
            }
            $data['proof_file'] = null; // Not needed for buy
            $wallet->increment('balance', $data['amount']);
        }

        $transaction = CryptoTransaction::create($data);

        AuditLog::create([

            'user_id' => $userId,
            'action' => 'crypto_transaction_created',
            'details' => json_encode($data),
            'created_at' => now(),
        ]);

        return $transaction;
    }

    public function updateTransactionStatus($transactionId, $status, $userId)
    {
        $transaction = CryptoTransaction::findOrFail($transactionId);
        $oldStatus = $transaction->status;

        $transaction->update(['status' => $status]);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'crypto_transaction_status_updated',
            'details' => json_encode([
                'transaction_id' => $transactionId,
                'old_status' => $oldStatus,
                'new_status' => $status,
            ]),
            'created_at' => now(),
        ]);

        return $transaction;
    }

    public function getAllTransactions($filters = [])
    {
        $query = CryptoTransaction::with(['user', 'cryptoCurrency']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        return $query->latest()->get();
    }

    public function getTransactionById($transactionId)
    {
        return CryptoTransaction::with(['user', 'cryptoCurrency'])->findOrFail($transactionId);
    }

    public function updateWalletBalance($cryptoId, $amount, $action, $userId)
    {
        $wallet = SystemWallet::firstOrCreate(
            ['crypto_currency_id' => $cryptoId],
            ['balance' => 0, 'address' => null]
        );

        if ($action === 'add') {
            $wallet->increment('balance', $amount);
        } elseif ($action === 'withdraw') {
            if ($wallet->balance < $amount) {
                throw new \Exception('Insufficient liquidity');
            }
            $wallet->decrement('balance', $amount);
        }

        AuditLog::create([
            'user_id' => $userId,
            'action' => "crypto_wallet_{$action}ed",
            'details' => json_encode(['crypto_id' => $cryptoId, 'amount' => $amount]),
            'created_at' => now(),
        ]);

        return $wallet;
    }
}