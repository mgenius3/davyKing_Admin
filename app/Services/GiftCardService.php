<?php


namespace App\Services;

use App\Models\GiftCard;
use App\Models\GiftCardTransaction;
use App\Models\Rate;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;

class GiftCardService
{
    public function createGiftCard($data, $userId)
    {
        $giftCard = GiftCard::create($data);
        AuditLog::create([
            'user_id' => $userId,
            'action' => 'gift_card_created',
            'details' => json_encode($data),
        ]);
        return $giftCard;
    }

    public function updateGiftCard($giftCardId, $data, $userId)
    {
        $giftCard = GiftCard::findOrFail($giftCardId);
        $oldData = $giftCard->toArray();
        $giftCard->update($data);
        AuditLog::create([
            'user_id' => $userId,
            'action' => 'gift_card_updated',
            'details' => json_encode(['old' => $oldData, 'new' => $data]),
        ]);
        return $giftCard;
    }

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
            'created_at' => now(),
        ]);

        return $transaction;
    }
  /* Fetch all transactions for a specific user.*/
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
     * Fetch a single transaction by its ID.
     */
    public function getTransactionById($transactionId)
    {
        return GiftCardTransaction::with(['user', 'giftCard'])
            ->findOrFail($transactionId);
    }

    /**
     * Fetch all transactions in the system.
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


    // Fetch all gift cards with filters
    public function getGiftCards($filters = [])
    {
        $query = GiftCard::query();

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }
        if (isset($filters['is_enabled'])) {
            $query->where('is_enabled', $filters['is_enabled']);
        }

        return $query->with('rates')->get();
    }

    // Fetch transactions with filters
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

        return $query->latest()->get(); // Changed from paginate to get for simplicity
    }

    // Update transaction status
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

    // Update gift card rates
    public function updateRates($giftCardId, $currency, $buyRate, $sellRate, $userId)
    {
        dump('hello');
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

    // Toggle gift card availability
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
