<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GiftCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionLogger;


class GiftCardController extends Controller
{
    protected $giftCardService;

    public function __construct(GiftCardService $giftCardService)
    {
        $this->giftCardService = $giftCardService;
        // Apply Sanctum authentication middleware
        $this->middleware('auth:sanctum');
    }

    /**
     * List all gift cards available to the user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->only(['category', 'is_enabled']);
            $giftCards = $this->giftCardService->getGiftCards($filters);

            return response()->json([
                'status' => 'success',
                'data' => $giftCards,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch gift cards: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show details of a specific gift card
     *
     * @param int $giftCardId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($giftCardId)
    {
        try {
            $giftCard = $this->giftCardService->getGiftCardById($giftCardId);

            if (!$giftCard) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gift card not found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $giftCard,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch gift card: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a new transaction (buy/sell gift card)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeTransaction(Request $request)
    {
        try {
            $request->validate([
                'name'=>'required',
                'gift_card_id' => 'required|exists:gift_cards,id',
                'type' => 'required|in:buy,sell',
                'amount' => 'nullable|numeric|min:0', // Optional, calculated if not provided
                'status' => 'required|in:pending,completed,rejected,flagged',
                'proof_file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
                'tx_hash' => 'nullable|string|max:255',
                'admin_notes' => 'nullable|string'
            ]);

            // Log the transaction attempt
            $log = TransactionLogger::log(
                transactionType: 'giftcard_purchase',
                referenceId: $request['gift_card_id'],
                details: [
                    'total_amount' => $request['amount'],
                    'message' => "Transaction for Gift Card {$request['name']}", 
                    'type' => $request['type']
                ],
                success: false // Initially false
            );

            $data = $request->all();
            if ($request->hasFile('proof_file')) {
                $data['proof_file'] = $request->file('proof_file')->store('proofs', 'public');
            }

            $transaction = $this->giftCardService->createTransaction($data, Auth::id());

            // Mark the log as successful
            TransactionLogger::updateSuccess($log->id, true);

            return response()->json([
                'status' => 'success',
                'data' => $transaction,
                'message' => 'Transaction created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create transaction: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * List transactions for the authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userTransactions(Request $request)
    {
        try {
            $filters = $request->only(['status', 'date_range']);
            $transactions = $this->giftCardService->getTransactionsByUser(Auth::id(), $filters);

            return response()->json([
                'status' => 'success',
                'data' => $transactions,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch transactions: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show details of a specific transaction
     *
     * @param int $transactionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function transaction($transactionId)
    {
        try {
            $transaction = $this->giftCardService->getTransactionById($transactionId);

            if (!$transaction || $transaction->user_id !== Auth::id()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found or unauthorized',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $transaction,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch transaction: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the status of a transaction (user-initiated, if allowed)
     *
     * @param Request $request
     * @param int $transactionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTransactionStatus(Request $request, $transactionId)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,completed,rejected,flagged',
                'notes' => 'nullable|string|max:500',
            ]);

            $transaction = $this->giftCardService->getTransactionById($transactionId);

            if (!$transaction || $transaction->user_id !== Auth::id()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction not found or unauthorized',
                ], 404);
            }

            $updatedTransaction = $this->giftCardService->updateTransactionStatus(
                $transactionId,
                $request->status,
                Auth::id(),
                $request->notes
            );

            return response()->json([
                'status' => 'success',
                'data' => $updatedTransaction,
                'message' => 'Transaction status updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update transaction status: ' . $e->getMessage(),
            ], 400);
        }
    }
}
