<x-template.user title="Transactions" slug="transactions">
    <x-user.page-banner>Transactions</x-user.page-banner>
    <x-user.section>
        <x-user.section-title>Transactions history</x-user.section-title>
        <x-user.section-description>
            All transactions carried out on your account are listed here.
        </x-user.section-description>
        <x-user.section-body>

            <form action="" class="row p-0 mb-4 g-3" method="get">
                <div class="form-group col-sm-4 col-md-4">
                    <label for="log_type">Log Type:</label>
                    <select id="log_type" name="log_type" class="form-control">
                        <option {{ request('log_type', '') == 'all' ? 'selected' : '' }} value="all">Show All Logs
                        </option>
                        <option {{ request('log_type', '') == 'deposit' ? 'selected' : '' }} value="deposit">Deposits
                        </option>
                        <option {{ request('log_type', '') == 'withdrawal' ? 'selected' : '' }} value="withdrawal">
                            Withdrawals</option>
                        <option {{ request('log_type', '') == 'deposit-earning' ? 'selected' : '' }}
                            value="deposit-earning">Deposit Earnings</option>
                        <option {{ request('log_type', '') == 'bonus' ? 'selected' : '' }} value="bonus">Bonus</option>
                        <option {{ request('log_type', '') == 'penalty' ? 'selected' : '' }} value="penalty">Penalty
                        </option>
                        <option {{ request('log_type', '') == 'referral' ? 'selected' : '' }} value="referral">Referral
                            Commission</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 col-md-2">
                    <label for="from">From:</label>
                    <input class="form-control" type="date" id="from" name="from"
                        value="{{ old('from') }}" />
                </div>
                <div class="form-group col-sm-4 col-md-2">
                    <label for="to">To:</label>
                    <input class="form-control" type="date" id="to" name="to"
                        value="{{ old('to') }}" />
                </div>
                <div class="form-group col-sm-4 col-md-2">
                    <label for="rpp">Per Page:</label>
                    <select id="rpp" name="rpp" class="form-control">
                        <option {{ request('rpp', '') == '20' ? 'selected' : '' }}>20</option>
                        <option {{ request('rpp', '') == '50' ? 'selected' : '' }}>50</option>
                        <option {{ request('rpp', '') == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 col-md-2">
                    <br class="d-flex d-sm-inline" />
                    <button type="submit" class="btn btn-danger btn-block">Go</button>
                </div>
            </form>
            {{-- actual transaction list --}}
            <x-user.transactions-log :transactions="$transactions" />
        </x-user.section-body>
    </x-user.section>
</x-template.user>
