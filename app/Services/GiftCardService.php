<?php

namespace App\Services;

use App\Models\GiftCard;
use App\Models\GiftCardTransaction;
use App\Models\Rate;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;

class GiftCardService
{
    /**
     * Create a new gift card
     *
     * @param array $data
     * @param int $userId
     * @return GiftCard
     */
    public function createGiftCard($data, $userId)
    {
        // Ensure ranges is an array and encode it as JSON if provided
        if (isset($data['ranges']) && is_array($data['ranges'])) {
            $data['ranges'] = json_encode($data['ranges']);
        }

        $giftCard = GiftCard::create($data);
        AuditLog::create([
            'user_id' => $userId,
            'action' => 'gift_card_created',
            'details' => json_encode($data),
        ]);
        return $giftCard;
    }


    /**
     * Update an existing gift card
     *
     * @param int $giftCardId
     * @param array $data
     * @param int $userId
     * @return GiftCard
     */
    public function updateGiftCard($giftCardId, $data, $userId)
    {
        $giftCard = GiftCard::findOrFail($giftCardId);
        $oldData = $giftCard->toArray();


        // Ensure ranges is an array and encode it as JSON if provided
        if (isset($data['ranges']) && is_array($data['ranges'])) {
            $data['ranges'] = json_encode($data['ranges']);
        }

        dump($data);
        $giftCard->update($data);
        AuditLog::create([
            'user_id' => $userId,
            'action' => 'gift_card_updated',
            'details' => json_encode(['old' => $oldData, 'new' => $data]),
        ]);
        return $giftCard;
    }

    /**
     * Create a new gift card transaction
     *
     * @param array $data
     * @param int $userId
     * @return GiftCardTransaction
     */
    
    public function createTransaction($data, $userId)
    {
        // Calculate amount based on type and gift card rates if not provided
        $giftCard = GiftCard::findOrFail($data['gift_card_id']);
        if (!isset($data['amount'])) {
            $data['amount'] = $data['type'] === 'buy'
                ? $giftCard->denomination * $giftCard->buy_rate
                : $giftCard->denomination * $giftCard->sell_rate;
        }

        $transaction = GiftCardTransaction::create($data);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'transaction_created',
            'details' => json_encode($data),
            'created_at' => now()
        ]);

        return $transaction;
    }

    /**
     * Fetch all transactions for a specific user
     *
     * @param int $userId
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTransactionsByUser($userId, $filters = [])
    {
        $query = GiftCardTransaction::where('user_id', $userId)
            ->with(['user', 'giftCard']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['date_range'])) {
            $query->whereBetween('created_at', $filters['date_range']);
        }

        return $query->latest()->get();
    }

    /**
     * Fetch a single transaction by its ID
     *
     * @param int $transactionId
     * @return GiftCardTransaction
     */
    public function getTransactionById($transactionId)
    {
        return GiftCardTransaction::with(['user', 'giftCard'])
            ->findOrFail($transactionId);
    }

    /**
     * Fetch all transactions in the system
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTransactions($filters = [])
    {
        $query = GiftCardTransaction::with(['user', 'giftCard']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
        if (isset($filters['date_range'])) {
            $query->whereBetween('created_at', $filters['date_range']);
        }

        return $query->latest()->get();
    }

    /**
     * Fetch all gift cards with filters
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGiftCards($filters = [])
    {
        $query = GiftCard::query();

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }
        if (isset($filters['is_enabled'])) {
            $query->where('is_enabled', $filters['is_enabled']);
        }

        $giftCards = $query->with('rates')->get();

        // Dynamically append the storage URL to the image field
        $storageUrl = url('/storage'); // Generates the base URL + /storage (e.g., http://localhost:8000/storage)
        return $giftCards->map(function ($giftCard) use ($storageUrl) {
            if ($giftCard->image) {
                $giftCard->image = $storageUrl . '/' . $giftCard->image;
            }
            return $giftCard;
        });
    }

    /**
     * Fetch a single gift card by its ID
     *
     * @param int $giftCardId
     * @return GiftCard|null
     */
    public function getGiftCardById($giftCardId)
    {
        $giftCard = GiftCard::with('rates')->find($giftCardId);

        // Dynamically append the storage URL to the image field
        if ($giftCard && $giftCard->image) {
            $storageUrl = url('/storage'); // Generates the base URL + /storage
            $giftCard->image = $storageUrl . '/' . $giftCard->image;
        }

        return $giftCard;
    }

    /**
     * Fetch transactions with filters
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTransactions($filters = [])
    {
        $query = GiftCardTransaction::with(['user', 'giftCard']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
        if (isset($filters['date_range'])) {
            $query->whereBetween('created_at', $filters['date_range']);
        }
        if (isset($filters['limit'])) {
            $query->limit($filters['limit']);
        }

        return $query->latest()->get();
    }

    /**
     * Update transaction status
     *
     * @param int $transactionId
     * @param string $status
     * @param int $userId
     * @param string|null $notes
     * @return GiftCardTransaction
     */
    public function updateTransactionStatus($transactionId, $status, $userId, $notes = null)
    {
        $transaction = GiftCardTransaction::findOrFail($transactionId);
        $transaction->status = $status;
        $transaction->admin_notes = $notes;
        $transaction->save();

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'transaction_updated',
            'details' => json_encode(['transaction_id' => $transactionId, 'status' => $status]),
        ]);

        return $transaction;
    }

    /**
     * Update gift card rates
     *
     * @param int $giftCardId
     * @param string $currency
     * @param float $buyRate
     * @param float $sellRate
     * @param int $userId
     * @return bool
     */
    public function updateRates($giftCardId, $currency, $buyRate, $sellRate, $userId)
    {
        $giftCard = GiftCard::findOrFail($giftCardId);
        $oldRates = ['buy_rate' => $giftCard->buy_rate, 'sell_rate' => $giftCard->sell_rate];

        // Update gift_cards table (primary rates)
        $giftCard->update([
            'buy_rate' => $buyRate,
            'sell_rate' => $sellRate,
        ]);

        Rate::updateOrCreate(
            ['gift_card_id' => $giftCardId, 'currency' => $currency],
            ['buy_rate' => $buyRate, 'sell_rate' => $sellRate, 'updated_by' => $userId]
        );

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'rate_updated',
            'details' => json_encode(['gift_card_id' => $giftCardId, 'old_rates' => $oldRates, 'new_rates' => [$buyRate, $sellRate]]),
        ]);

        return true;
    }

    /**
     * Toggle gift card availability
     *
     * @param int $giftCardId
     * @param bool $isEnabled
     * @param int $userId
     * @return GiftCard
     */
    public function toggleGiftCard($giftCardId, $isEnabled, $userId)
    {
        $giftCard = GiftCard::findOrFail($giftCardId);
        $giftCard->is_enabled = $isEnabled;
        $giftCard->save();

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'gift_card_toggled',
            'details' => json_encode(['gift_card_id' => $giftCardId, 'is_enabled' => $isEnabled]),
        ]);

        return $giftCard;
    }
}
