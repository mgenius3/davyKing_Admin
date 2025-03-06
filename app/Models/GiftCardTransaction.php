<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCardTransaction extends Model
{
    protected $fillable = ['user_id', 'gift_card_id', 'type', 'amount', 'status', 'proof_file', 'tx_hash', 'admin_notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function giftCard()
    {
        return $this->belongsTo(GiftCard::class);
    }
}