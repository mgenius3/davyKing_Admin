<?php

namespace App\Services;

use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Models\SystemWallet;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Add this import for the DB facade

class CryptoService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getCryptoCurrency(array $filters = [])
    {
        $query = CryptoCurrency::query();

        // Apply filters
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['is_enabled'])) {
            $query->where('is_enabled', $filters['is_enabled']);
        }

        // Execute the query to get a Collection
        $cryptos = $query->get();

        // Fetch system wallet balances for all crypto currencies
        $systemWallets = SystemWallet::whereIn('crypto_currency_id', $cryptos->pluck('id'))
            ->get()
            ->keyBy('crypto_currency_id');

        // Dynamically append the storage URL to the image field
        $storageUrl = url('/storage'); // Generates the base URL + /storage (e.g., http://localhost:8000/storage)

        // Merge the balance into the cryptocurrency data and append storage URL to image
        return $cryptos->map(function ($crypto) use ($systemWallets, $storageUrl) {
            $wallet = $systemWallets->get($crypto->id);
            return [
                'id' => $crypto->id,
                'name' => $crypto->name,
                'symbol' => $crypto->symbol,
                'category' => $crypto->category,
                'network' => $crypto->network,
                'buy_rate' => $crypto->buy_rate,
                'sell_rate' => $crypto->sell_rate,
                'image' => $crypto->image ? $storageUrl . '/' . $crypto->image : null, // Append storage URL to image
                'is_enabled' => $crypto->is_enabled,
                'created_at' => $crypto->created_at,
                'updated_at' => $crypto->updated_at,
                'liquid_balance' => $wallet ? (float) $wallet->balance : 0.0, // Add balance from SystemWallet
            ];
        });
    }

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
        return DB::transaction(function () use ($data, $userId) {
            $crypto = CryptoCurrency::findOrFail($data['crypto_currency_id']);
            $data['fiat_amount'] = $data['type'] === 'buy'
                ? $data['amount'] * $crypto->buy_rate
                : $data['amount'] * $crypto->sell_rate;

            // Deduct from user's wallet for buy transactions with wallet_balance
            if ($data['type'] === 'buy' && $data['payment_method'] === 'wallet_balance') {
                $fiatAmount = $data['fiat_amount'];
                $user = $this->userService->deductWallet($userId, $fiatAmount);
                if (!$user) {
                    dump("Insufficient wallet balance for this transaction");
                    throw new \Exception('Insufficient wallet balance for this transaction');
                }

                // Log the wallet deduction
                AuditLog::create([
                    'user_id' => $userId,
                    'action' => 'user_wallet_deducted',
                    'details' => json_encode([
                        'user_id' => $userId,
                        'amount' => $fiatAmount,
                        'reason' => 'Crypto buy transaction with wallet balance',
                    ]),
                    'created_at' => now(),
                ]);
            }

            $wallet = SystemWallet::firstOrCreate(
                ['crypto_currency_id' => $data['crypto_currency_id']],
                ['balance' => 0]
            );

            if ($data['type'] === 'sell') {
                if (!isset($data['proof_file']) || !$data['proof_file']) {
                    throw new \Exception('Proof of coin transfer is required for sell transactions');
                }
                // Store the proof file
                $data['proof_file'] = $data['proof_file']->store('crypto_proofs', 'public');
                $data['wallet_address'] = null; // Not needed for sell
                if ($wallet->balance < $data['amount']) {
                    throw new \Exception('Insufficient system liquidity for sell');
                }
                $wallet->decrement('balance', $data['amount']);
            } elseif ($data['type'] === 'buy') {
                if ($data['payment_method'] === 'bank_transfer') {
                    if (!isset($data['proof_file']) || !$data['proof_file']) {
                        throw new \Exception('Proof of money transfer is required for buy transactions with bank transfer');
                    }
                    $data['proof_file'] = $data['proof_file']->store('crypto_proofs', 'public');
                } else {
                    $data['proof_file'] = null; // No proof file for wallet_balance
                }

                if (!isset($data['wallet_address']) || !$data['wallet_address']) {
                    throw new \Exception('Wallet address is required for buy transactions');
                }
                $wallet->increment('balance', $data['amount']);
            }

            $transaction = CryptoTransaction::create($data);
            AuditLog::create([
                'user_id' => $userId,
                'action' => 'crypto_transaction_created',
                'details' => json_encode($data),
                'created_at' => now()
            ]);
            return $transaction;
        });
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

    public function toggleCrypto($cryptoId, $isEnabled, $userId)
    {
        $crypto = CryptoCurrency::findOrFail($cryptoId);
        $crypto->update(['is_enabled' => $isEnabled]);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'crypto_currency_toggled',
            'details' => json_encode(['crypto_id' => $cryptoId, 'is_enabled' => $isEnabled]),
            'created_at' => now(),
        ]);

        return $crypto;
    }

    public function deleteCrypto($cryptoId, $userId)
    {
        $crypto = CryptoCurrency::findOrFail($cryptoId);

        // Optionally delete associated image if it exists
        if ($crypto->image && Storage::disk('public')->exists($crypto->image)) {
            Storage::disk('public')->delete($crypto->image);
        }

        $crypto->delete();

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'crypto_currency_deleted',
            'details' => json_encode(['crypto_id' => $cryptoId, 'name' => $crypto->name]),
            'created_at' => now()
        ]);
    }

    public function deleteTransaction($transactionId, $userId)
    {
        $transaction = CryptoTransaction::findOrFail($transactionId);

        // Optionally delete associated proof file if it exists
        if ($transaction->proof_file && Storage::disk('public')->exists($transaction->proof_file)) {
            Storage::disk('public')->delete($transaction->proof_file);
        }

        $transaction->delete();

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'crypto_transaction_deleted',
            'details' => json_encode(['transaction_id' => $transactionId]),
            'created_at' => now(),
        ]);
    }
}