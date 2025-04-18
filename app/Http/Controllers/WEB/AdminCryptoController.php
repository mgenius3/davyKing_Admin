<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Services\CryptoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CryptoCurrency;
use App\Models\User;
use App\Models\SystemWallet;
use App\Services\TransactionLogger;


class AdminCryptoController extends Controller
{
    protected $cryptoService;

    public function __construct(CryptoService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function adminPage()
    {
        $cryptos = CryptoCurrency::all();
        $transactions = $this->cryptoService->getAllTransactions()->take(5);
        $wallets = SystemWallet::with('cryptoCurrency')->get();
        return view('crypto_management.display', compact('cryptos', 'transactions', 'wallets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10|unique:crypto_currencies',
            'network' => 'nullable|string|max:50',
            'buy_rate' => 'required|numeric|min:0',
            'sell_rate' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048', // Max 2MB, like gift cards
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cryptocurrencies', 'public');
        }

        $this->cryptoService->createCryptoCurrency($data, Auth::id());
        return redirect()->back()->with('success', 'Cryptocurrency added successfully');
    }

    public function updateRates(Request $request)
    {
        $request->validate([
            'crypto_id' => 'required|exists:crypto_currencies,id',
            'buy_rate' => 'required|numeric|min:0',
            'sell_rate' => 'required|numeric|min:0'
        ]);

        $this->cryptoService->updateCryptoCurrency(
            $request->crypto_id,
            ['buy_rate' => $request->buy_rate, 'sell_rate' => $request->sell_rate],
            Auth::id()
        );
        return redirect()->back()->with('success', 'Rates updated successfully');
    }

    public function createTransaction()
    {
        $cryptos = CryptoCurrency::where('is_enabled', true)->get();
        $users = User::all();
        return view('crypto_management.create_transaction', compact('cryptos', 'users'));
    }

    public function storeTransaction(Request $request)
    {
        $rules = [
            'crypto_name' => 'required',
            'user_id' => 'required|exists:users,id',
            'crypto_currency_id' => 'required|exists:crypto_currencies,id',
            'type' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:0|max:1000000',
            'payment_method' => 'nullable|in:bank_transfer,wallet_balance',
            'tx_hash' => 'nullable|string|max:255',
        ];



        // Log the transaction attempt
        $log = TransactionLogger::log(
            transactionType: 'crypto_purchase',
            referenceId: $request['crypto_currency_id'],
            details: [
                'total_amount' => $request['amount'],
                'message' => "Transaction for Crypto {$request['crypto_name']}", 
                'type' => $request['type']
            ],
            success: false // Initially false
        );


        if ($request->type === 'sell') {
            $rules['proof_file'] = 'required|file|mimes:jpg,png,pdf|max:2048';
        } elseif ($request->type === 'buy') {
            $rules['wallet_address'] = 'required|string|max:255';
            if ($request->payment_method === 'bank_transfer') {
                $rules['proof_file'] = 'required|file|mimes:jpg,png,pdf|max:2048';
            }
            // No proof_file rule for wallet_balance
        }

        $request->validate($rules);

        $data = $request->all();
        if ($request->hasFile('proof_file')) {
            $data['proof_file'] = $request->file('proof_file');
        }

        try {
            $this->cryptoService->createTransaction($data, $request->user_id);
            return redirect()->route('admin.crypto')->with('success', 'Transaction created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function allTransactions()
    {
        $transactions = $this->cryptoService->getAllTransactions();
        return view('crypto_management.all_transaction', compact('transactions'));
    }

    public function transaction($transactionId)
    {
        $transaction = $this->cryptoService->getTransactionById($transactionId);
        return view('crypto_management.transaction', compact('transaction'));
    }

    public function editTransactionStatus($transactionId)
    {
        $transaction = $this->cryptoService->getTransactionById($transactionId);
        return view('crypto_management.update_transaction_status', compact('transaction'));
    }

    public function updateTransactionStatus(Request $request, $transactionId)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        $this->cryptoService->updateTransactionStatus($transactionId, $request->status, Auth::id());
        return redirect()->route('admin.crypto.transaction', $transactionId)->with('success', 'Transaction status updated successfully');
    }

    public function updateLiquidity(Request $request)
    {
        $request->validate([
            'crypto_id' => 'required|exists:crypto_currencies,id',
            'amount' => 'required|numeric|min:0',
            'action' => 'required|in:add,withdraw'
        ]);

        $this->cryptoService->updateWalletBalance($request->crypto_id, $request->amount, $request->action, Auth::id());
        return redirect()->back()->with('success', "Liquidity {$request->action}ed successfully");
    }

    // Toggle cryptocurrency availability
    public function toggle(Request $request, $cryptoId)
    {
        $request->validate([
            'is_enabled' => 'required|boolean',
        ]);

        $crypto = $this->cryptoService->toggleCrypto($cryptoId, $request->is_enabled, Auth::id());

        return redirect()->back()->with('success', 'Cryptocurrency status updated successfully');
    }

    // Delete a cryptocurrency
    public function deleteCrypto($cryptoId)
    {
        try {
            $this->cryptoService->deleteCrypto($cryptoId, Auth::id());
            return redirect()->back()->with('success', 'Cryptocurrency deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete cryptocurrency: ' . $e->getMessage());
        }
    }

    // Delete a transaction
    public function deleteTransaction($transactionId)
    {
        try {
            $this->cryptoService->deleteTransaction($transactionId, Auth::id());
            return redirect()->route('admin.crypto.all-transactions')->with('success', 'Transaction created successfully');
            // return redirect()->back()->with('success', 'Transaction deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete transaction: ' . $e->getMessage());
        }
    }
}