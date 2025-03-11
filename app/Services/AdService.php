<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;

class AdService
{
    public function createAd($data, $userId)
    {
        if (isset($data['image']) && $data['image']) {
            $data['image_url'] = $data['image']->store('ads', 'public');
        }

        $ad = Ad::create($data);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'ad_created',
            'details' => json_encode($data),
            'created_at' => now(),
        ]);

        return $ad;
    }

    public function updateAd($adId, $data, $userId)
    {
        $ad = Ad::findOrFail($adId);
        $oldData = $ad->toArray();

        if (isset($data['image']) && $data['image']) {
            if ($ad->image_url) {
                Storage::disk('public')->delete($ad->image_url);
            }
            $data['image_url'] = $data['image']->store('ads', 'public');
        }

        $ad->update($data);

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'ad_updated',
            'details' => json_encode(['old' => $oldData, 'new' => $data]),
            'created_at' => now(),
        ]);

        return $ad;
    }

    public function deleteAd($adId, $userId)
    {
        $ad = Ad::findOrFail($adId);
        if ($ad->image_url) {
            Storage::disk('public')->delete($ad->image_url);
        }
        $ad->delete();

        AuditLog::create([
            'user_id' => $userId,
            'action' => 'ad_deleted',
            'details' => json_encode(['ad_id' => $adId]),
            'created_at' => now(),
        ]);
    }

    public function getActiveAds()
    {
        return Ad::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('start_date')
                      ->orWhereRaw('start_date <= NOW()');
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhereRaw('end_date >= NOW()');
            })
            ->orderBy('priority', 'desc')
            ->get();
    }
}