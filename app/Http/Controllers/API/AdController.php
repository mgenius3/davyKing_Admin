<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AdService;

class AdController extends Controller
{
    protected $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }

    public function index()
    {
        $ads = $this->adService->getActiveAds();
        return response()->json([
            'status' => 'success',
            'data' => $ads->map(function ($ad) {
                return [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'description' => $ad->description,
                    'image_url' => $ad->image_url ? asset('storage/' . $ad->image_url) : null,
                    'target_url' => $ad->target_url,
                    'type' => $ad->type,
                    'priority' => $ad->priority,
                    'is_active' => $ad->is_active
                ];
            }),
        ]);
    }
}