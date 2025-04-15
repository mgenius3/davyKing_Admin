<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
protected $fillable = [
'name',
'category',
'denomination',
'buy_rate',
'sell_rate',
'image',
'is_enabled',
'stock',
'ranges', // Add ranges to fillable
];

protected $casts = [
'ranges' => 'array', // Cast JSON to array
];

public function rates()
{
return $this->hasMany(Rate::class, 'gift_card_id');
}

public function transactions()
{
return $this->hasMany(GiftCardTransaction::class, 'gift_card_id');
}
}