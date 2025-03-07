@extends('layout.default')

@section('title', 'Crypto Transaction Details')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <h1 class="page-header mb-0">Transaction #{{ $transaction->id }}</h1>
        <div class="ms-auto">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h5 class="mb-0">Transaction Details</h5>
            <span class="ms-auto badge {{ $transaction->status == 'completed' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($transaction->status) }}</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>User:</strong> {{ $transaction->user->name }}</p>
                    <p><strong>Cryptocurrency:</strong> {{ $transaction->cryptoCurrency->name }} ({{ $transaction->cryptoCurrency->symbol }})</p>
                    <p><strong>Type:</strong> {{ ucfirst($transaction->type) }}</p>
                    <p><strong>Amount:</strong> {{ $transaction->amount }} {{ $transaction->cryptoCurrency->symbol }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fiat Amount:</strong> ${{ $transaction->fiat_amount }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</p>
                    <p><strong>Wallet Address:</strong> {{ $transaction->wallet_address ?? 'N/A' }}</p>
                    <p><strong>Transaction Hash:</strong> {{ $transaction->tx_hash ?? 'N/A' }}</p>
                    <p><strong>Confirmations:</strong> {{ $transaction->confirmations }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-end">
            <a href="{{ route('admin.crypto.edit-transaction-status', $transaction->id) }}" class="btn btn-primary">
                <i class="fa fa-sync me-1"></i> Update Status
            </a>
        </div>
    </div>
@endsection