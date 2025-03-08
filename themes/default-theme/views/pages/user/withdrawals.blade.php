<x-template.user title="Withdrawals" slug="withdrawals">
    <x-user.page-banner>Withdrawal</x-user.page-banner>
    <x-general.flash-bag />
    <x-user.section>
        <x-user.section-title>Place a Withdrawal Request</x-user.section-title>
        <x-user.section-description>
            Fill out the form below to place a new withdrawal request. Mininum withrawal amount is
            <strong>${{ number_format($min_withdrawal, 2) }}</strong>. This miminum withdrawal applies if there is no
            minimum withdrawal set for each wallet. <strong>The withdrawable amount is the maximum you can withdraw
                after
                subtracting charges.</strong> Select wallet to see wallet minimum and maximum withdrawal amounts. Please
            make sure you have saved your <a href="{{ route('user.profile') }}">withdrawal wallets here.</a>
        </x-user.section-description>
        <x-user.section-body>
            <form method="post" class="row g-3">
                @csrf
                <div class="form-group col-md-6">
                    <label for="wallet_id">Select Wallet</label>
                    <select id="wallet_id" name="wallet_id" class="form-control" onchange="changeWallet()" required>
                        @foreach ($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->currency_code }}
                                (Balance: ${{ number_format($wallet->balance, 2) }}; Withdrawable:
                                ${{ number_format($wallet->withdrawable, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Withdrawal Amount</label>
                    <input class="form-control" id="amount" type="number" name="amount" min="{{ $min_withdrawal }}"
                        value="{{ $min_withdrawal }}" required />
                </div>
                @foreach ($wallets as $wallet)
                    <div class="wallet-info form-group col-sm-12" style="display:none" id="wallet-{{ $wallet->id }}">
                        <div class="alert alert-info m-0 p-2 pb-0">
                            <p><strong>Balance:</strong> ${{ number_format($wallet->balance, 2) }}</p>
                            <p><strong>Withdrawable:</strong> ${{ number_format($wallet->withdrawable, 2) }}</p>
                            @if ($wallet->min_withdrawal)
                                <p><strong>Minimum Withdrawal:</strong> ${{ number_format($wallet->min_withdrawal, 2) }}
                                </p>
                            @endif
                            @if ($wallet->max_withdrawal)
                                <p><strong>Maximum Withdrawal:</strong> ${{ number_format($wallet->max_withdrawal, 2) }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
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
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mr-2">Make Withdrawal</button>
                </div>
            </form>
        </x-user.section-body>
    </x-user.section>

    <x-user.section>
        <x-user.section-title>Withdrawals history</x-user.section-title>
        <x-user.section-description>Below is a list of your withdrawals so far.</x-user.section-description>
        <x-user.section-body>

            <form action="" class="row container p-0 mb-4 g-2" method="get">
                <div class="form-group col-sm-4 col-md-3">
                    <label for="status">Withdrawal Status:</label>
                    <select id="status" name="status" class="form-control">
                        <option {{ request('status', '') == '' ? 'selected' : null }} value="">Show All
                        </option>
                        <option {{ request('status', '') == 'approved' ? 'selected' : null }} value="approved">
                            Approved</option>
                        <option {{ request('status', '') == 'pending' ? 'selected' : null }} value="pending">
                            Pending</option>
                        <option {{ request('status', '') == 'declined' ? 'selected' : null }} value="declined">
                            Declined</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="from">From:</label>
                    <input class="form-control" type="date" id="from" name="from"
                        value="{{ old('from') }}" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label for="to">To:</label>
                    <input class="form-control" type="date" id="to" name="to"
                        value="{{ old('to') }}" />
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <br class="d-flex d-md-inline" />
                    <button type="submit" class="btn btn-danger btn-block">Go</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
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
                                        <strong>
                                            {{ $trans->username }}
                                        </strong>&nbsp;
                                        <small
                                            class="badge 
                                            {{ $trans->status == 'pending' ? 'bg-info' : '' }}
                                            {{ $trans->status == 'declined' ? 'danger' : '' }}
                                            {{ $trans->status == 'approved' ? 'success' : '' }}
                                            ">{{ $trans->status }}</small>
                                    </td>
                                    <td>
                                        ${{ $trans->amount }}<br class="d-none d-lg-inline" />
                                    </td>
                                    <td class="text-danger">
                                        <a href="{{ route('user.withdrawals.view', ['id' => $trans->id]) }}"
                                            title="View full details" class="btn btn-primary btn-sm mb-1">view</i></a>
                                        @if ($trans->status === 'pending')
                                            <a href="{{ route('user.withdrawals.delete', ['id' => $trans->id]) }}"
                                                class="btn btn-danger btn-sm mb-1" title="Delete record"
                                                onclick="return confirm('Are you sure you want to cancel this withdrawal request?')">delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No data found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{ $withdrawals->links() }}

        </x-user.section-body>
    </x-user.section>
</x-template.user>
