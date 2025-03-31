<x-template.user title="Withdrawals" slug="withdrawals">
    <x-user.page-banner>Withdrawal</x-user.page-banner>
    <x-general.flash-bag />
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card bg-dark border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="text-white mb-0">Place a Withdrawal Request</h5>
                        <p class="text-muted mb-0">
                            Fill out the form below to place a new withdrawal request. Minimum withdrawal amount is
                            <strong>${{ number_format($min_withdrawal, 2) }}</strong>. This minimum withdrawal applies if there is no
                            minimum withdrawal set for each wallet. <strong>The withdrawable amount is the maximum you can withdraw after
                            subtracting charges.</strong> Select wallet to see wallet minimum and maximum withdrawal amounts. Please
                            make sure you have saved your <a href="{{ route('user.profile') }}" class="text-primary">withdrawal wallets here</a>.
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="post" class="row g-4">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="wallet_id" class="text-white">Select Wallet</label>
                                <select id="wallet_id" name="wallet_id" class="form-control bg-dark text-white border-secondary" onchange="changeWallet()" required>
                                    @foreach ($wallets as $wallet)
                                        <option value="{{ $wallet->id }}">{{ $wallet->currency_code }}
                                            (Balance: ${{ number_format($wallet->balance, 2) }}; Withdrawable:
                                            ${{ number_format($wallet->withdrawable, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="amount" class="text-white">Withdrawal Amount</label>
                                <input class="form-control bg-dark text-white border-secondary" id="amount" type="number" name="amount" min="{{ $min_withdrawal }}"
                                    value="{{ $min_withdrawal }}" required />
                            </div>
                            @foreach ($wallets as $wallet)
                                <div class="wallet-info form-group col-sm-12" style="display:none" id="wallet-{{ $wallet->id }}">
                                    <div class="alert alert-info bg-dark border-secondary text-white m-0 p-3">
                                        <p class="mb-1"><strong>Balance:</strong> ${{ number_format($wallet->balance, 2) }}</p>
                                        <p class="mb-1"><strong>Withdrawable:</strong> ${{ number_format($wallet->withdrawable, 2) }}</p>
                                        @if ($wallet->min_withdrawal)
                                            <p class="mb-1"><strong>Minimum Withdrawal:</strong> ${{ number_format($wallet->min_withdrawal, 2) }}</p>
                                        @endif
                                        @if ($wallet->max_withdrawal)
                                            <p class="mb-0"><strong>Maximum Withdrawal:</strong> ${{ number_format($wallet->max_withdrawal, 2) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Make Withdrawal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card bg-dark border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="text-white mb-0">Withdrawals History</h5>
                        <p class="text-muted mb-0">Below is a list of your withdrawals so far.</p>
                    </div>
                    <div class="card-body">
                        <form action="" class="row g-4 mb-4" method="get">
                            <div class="form-group col-sm-4 col-md-3">
                                <label for="status" class="text-white">Withdrawal Status:</label>
                                <select id="status" name="status" class="form-control bg-dark text-white border-secondary">
                                    <option {{ request('status', '') == '' ? 'selected' : null }} value="">Show All</option>
                                    <option {{ request('status', '') == 'approved' ? 'selected' : null }} value="approved">Approved</option>
                                    <option {{ request('status', '') == 'pending' ? 'selected' : null }} value="pending">Pending</option>
                                    <option {{ request('status', '') == 'declined' ? 'selected' : null }} value="declined">Declined</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 col-md-3">
                                <label for="from" class="text-white">From:</label>
                                <input class="form-control bg-dark text-white border-secondary" type="date" id="from" name="from" value="{{ old('from') }}" />
                            </div>
                            <div class="form-group col-sm-4 col-md-3">
                                <label for="to" class="text-white">To:</label>
                                <input class="form-control bg-dark text-white border-secondary" type="date" id="to" name="to" value="{{ old('to') }}" />
                            </div>
                            <div class="form-group col-sm-4 col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover text-white">
                                <thead>
                                    <tr>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($withdrawals)
                                        @foreach ($withdrawals as $index => $trans)
                                            <tr>
                                                <td>
                                                    <strong>{{ $trans->username }}</strong>
                                                    <span class="badge bg-{{ $trans->status == 'pending' ? 'warning' : ($trans->status == 'declined' ? 'danger' : 'success') }} ms-2">
                                                        {{ ucfirst($trans->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-primary">${{ $trans->amount }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.withdrawals.view', ['id' => $trans->id]) }}" 
                                                       class="btn btn-sm btn-outline-primary mb-1">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>
                                                    @if ($trans->status === 'pending')
                                                        <a href="{{ route('user.withdrawals.delete', ['id' => $trans->id]) }}"
                                                           class="btn btn-sm btn-outline-danger mb-1"
                                                           onclick="return confirm('Are you sure you want to cancel this withdrawal request?')">
                                                            <i class="fas fa-trash me-1"></i> Cancel
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No withdrawals found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeWallet() {
            wallet = document.getElementById("wallet_id");
            // hide all
            document.querySelectorAll(".wallet-info").forEach(element => {
                element.style.display = "none";
            });
            // show needed
            document.getElementById("wallet-" + wallet.value).style.display = "block";
        }
        changeWallet();
    </script>
</x-template.user>
