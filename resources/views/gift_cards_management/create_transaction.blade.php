@extends('layout.default')

@section('title', 'Create Gift Card Transaction')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.gift-cards') }}">Gift Cards</a></li>
                <li class="breadcrumb-item active">CREATE TRANSACTION</li>
            </ol>
            <h1 class="page-header mb-0">Create Gift Card Transaction</h1>
        </div>
        <div class="ms-auto">
            <span class="text-body">Welcome, {{ Auth::user()->name }}</span>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center bg-none fw-semibold">
            New Transaction
        </div>
        <div class="card-body">
            <form action="{{ route('admin.gift-cards.store-transaction') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select class="form-select" name="user_id" required>
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Gift Card</label>
                    <select class="form-select" name="gift_card_id" required>
                        <option value="">Select a gift card</option>
                        @foreach ($giftCards as $giftCard)
                            <option value="{{ $giftCard->id }}">{{ $giftCard->name }} (${{ $giftCard->denomination }})</option>
                        @endforeach
                    </select>
                    @error('gift_card_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Transaction Type</label>
                    <select class="form-select" name="type" required>
                        <option value="">Select type</option>
                        <option value="buy">Buy</option>
                        <option value="sell">Sell</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount <small>(Leave blank to auto-calculate based on rates)</small></label>
                    <input type="number" step="0.01" class="form-control" name="amount" placeholder="e.g., 40.00">
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                        <option value="flagged">Flagged</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Proof File <small>(Optional: JPG, PNG, PDF)</small></label>
                    <input type="file" class="form-control" name="proof_file" accept="image/*,application/pdf">
                    @error('proof_file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Transaction Hash <small>(Optional)</small></label>
                    <input type="text" class="form-control" name="tx_hash" placeholder="e.g., 0x123abc...">
                    @error('tx_hash')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Admin Notes <small>(Optional)</small></label>
                    <textarea class="form-control" name="admin_notes" rows="3" placeholder="e.g., Manual entry by admin"></textarea>
                    @error('admin_notes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.gift-cards') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-theme">Create Transaction</button>
                </div>
            </form>
        </div>
    </div>
@endsection