@extends('layout.default')

@section('title', 'Crypto Management')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <h1 class="page-header mb-0">Crypto Management</h1>
        <div class="ms-auto">
            <span class="text-body">Welcome, {{ Auth::user()->name }}</span>
        </div>
    </div>

    <div class="row gx-4">
        <div class="col-xl-8">
            <!-- Crypto Catalog -->
            <div class="card mb-4">
                <div class="card-header bg-none fw-semibold">
                    Supported Cryptocurrencies ({{ $cryptos->count() }})
                    <a href="#" class="ms-auto text-body text-opacity-50" data-bs-toggle="modal" data-bs-target="#addCryptoModal">Add Crypto</a>
                </div>
                <div class="card-body">
                    @foreach ($cryptos as $crypto)
                        <div class="row align-items-center">
                            <div class="col-md-4">{{ $crypto->name }} ({{ $crypto->symbol }})</div>
                            <div class="col-md-4">Buy: ${{ $crypto->buy_rate }} | Sell: ${{ $crypto->sell_rate }}</div>
                            <div class="col-md-4 text-end">
                                <span class="badge {{ $crypto->is_enabled ? 'bg-success' : 'bg-danger' }}">{{ $crypto->is_enabled ? 'Enabled' : 'Disabled' }}</span>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <hr class="my-3">
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Transaction History -->
            <div class="card">
                <div class="card-header bg-none fw-semibold">
                    Recent Transactions ({{ $transactions->count() }})
                    <a href="{{ route('admin.crypto.all-transactions') }}" class="ms-auto text-body text-opacity-50">View All</a>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Crypto</th>
                                <th>Type</th>
                                <th>Fiat Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->cryptoCurrency->symbol }}</td>
                                    <td>{{ ucfirst($transaction->type) }}</td>
                                    <td>${{ $transaction->fiat_amount }}</td>
                                    <td><span class="badge {{ $transaction->status == 'completed' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($transaction->status) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <!-- Rate Management -->
            <div class="card mb-4">
                <div class="card-header bg-none fw-semibold">Rate Management</div>
                <div class="card-body">
                    <form action="{{ route('admin.crypto.update-rates') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Crypto</label>
                            <select class="form-select" name="crypto_id">
                                @foreach ($cryptos as $crypto)
                                    <option value="{{ $crypto->id }}">{{ $crypto->name }} ({{ $crypto->symbol }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Buy Rate</label>
                            <input type="number" step="0.01" class="form-control" name="buy_rate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sell Rate</label>
                            <input type="number" step="0.01" class="form-control" name="sell_rate" required>
                        </div>
                        <button type="submit" class="btn btn-theme">Update Rates</button>
                    </form>
                </div>
            </div>

            <!-- Liquidity Management -->
            <div class="card">
                <div class="card-header bg-none fw-semibold">Liquidity Management</div>
                <div class="card-body">
                    @foreach ($wallets as $wallet)
                        <div class="mb-3">
                            <strong>{{ $wallet->cryptoCurrency->symbol }}:</strong> {{ $wallet->balance }}
                        </div>
                    @endforeach
                    <form action="{{ route('admin.crypto.update-liquidity') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Crypto</label>
                            <select class="form-select" name="crypto_id">
                                @foreach ($cryptos as $crypto)
                                    <option value="{{ $crypto->id }}">{{ $crypto->symbol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" step="0.00000001" class="form-control" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Action</label>
                            <select class="form-select" name="action">
                                <option value="add">Add</option>
                                <option value="withdraw">Withdraw</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-theme">Update Liquidity</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Crypto Modal -->
    <div class="modal fade" id="addCryptoModal" tabindex="-1" aria-labelledby="addCryptoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCryptoModalLabel">Add New Cryptocurrency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.crypto.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Symbol</label>
                            <input type="text" class="form-control" name="symbol" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Network</label>
                            <input type="text" class="form-control" name="network" placeholder="e.g., Bitcoin, ERC-20">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Buy Rate</label>
                            <input type="number" step="0.01" class="form-control" name="buy_rate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sell Rate</label>
                            <input type="number" step="0.01" class="form-control" name="sell_rate" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-theme">Add Cryptocurrency</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection