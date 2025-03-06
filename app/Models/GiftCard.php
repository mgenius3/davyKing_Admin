<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $fillable = ['name', 'category', 'denomination', 'buy_rate', 'sell_rate', 'is_enabled', 'stock', 'image'];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function transactions()
    {
        return $this->hasMany(GiftCardTransaction::class);
    }
}