@extends('layout.default')

@section('title', 'Create Crypto Transaction')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="page-header mb-0">Create Crypto Transaction</h1>
    </div>

    <div class="card">
        <div class="card-header bg-none fw-semibold">New Transaction</div>
        <div class="card-body">
            <form action="{{ route('admin.crypto.store-transaction') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" required>
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Cryptocurrency</label>
                    <select class="form-select @error('crypto_currency_id') is-invalid @enderror" name="crypto_currency_id" required>
                        <option value="">Select a cryptocurrency</option>
                        @foreach ($cryptos as $crypto)
                            <option value="{{ $crypto->id }}">{{ $crypto->name }} ({{ $crypto->symbol }})</option>
                        @endforeach
                    </select>
                    @error('crypto_currency_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" name="type" id="transactionType" required>
                        <option value="">Select type</option>
                        <option value="buy">Buy</option>
                        <option value="sell">Sell</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount (in crypto)</label>
                    <input type="number" step="0.00000001" class="form-control @error('amount') is-invalid @enderror" name="amount" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select class="form-select @error('payment_method') is-invalid @enderror" name="payment_method" required>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="wallet_balance">Wallet Balance</option>
                    </select>
                    @error('payment_method')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="walletAddressField" style="display: none;">
                    <label class="form-label">Wallet Address (to receive crypto)</label>
                    <input type="text" class="form-control @error('wallet_address') is-invalid @enderror" name="wallet_address">
                    @error('wallet_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="proofFileField" style="display: none;">
                    <label class="form-label">Proof of Money Transfer (e.g., bank receipt)</label>
                    <input type="file" class="form-control @error('proof_file') is-invalid @enderror" name="proof_file" accept="image/*,application/pdf">
                    @error('proof_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Transaction Hash (optional)</label>
                    <input type="text" class="form-control @error('tx_hash') is-invalid @enderror" name="tx_hash">
                    @error('tx_hash')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.crypto') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-theme">Create Transaction</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('other_scripts')
<script>
    document.getElementById('transactionType').addEventListener('change', function() {
        const type = this.value;
        const walletAddressField = document.getElementById('walletAddressField');
        const proofFileField = document.getElementById('proofFileField');

        if (type === 'buy') {
            walletAddressField.style.display = 'block';
            proofFileField.style.display = 'none';
            document.querySelector('input[name="wallet_address"]').required = true;
            document.querySelector('input[name="proof_file"]').required = false;
        } else if (type === 'sell') {
            walletAddressField.style.display = 'none';
            proofFileField.style.display = 'block';
            document.querySelector('input[name="wallet_address"]').required = false;
            document.querySelector('input[name="proof_file"]').required = true;
        } else {
            walletAddressField.style.display = 'none';
            proofFileField.style.display = 'none';
            document.querySelector('input[name="wallet_address"]').required = false;
            document.querySelector('input[name="proof_file"]').required = false;
        }
    });
</script>
@endpush