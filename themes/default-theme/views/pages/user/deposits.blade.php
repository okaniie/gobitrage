<x-template.user title="Deposits" slug="deposits">
    <x-user.page-banner>Deposits</x-user.page-banner>
    <x-general.flash-bag />
    <x-user.section>
        <x-user.section-title>Make a Deposit</x-user.section-title>
        <x-user.section-description>Fill out the form below to make a new deposit now.</x-user.section-description>
        <x-user.section-body>
            <form id="new_deposit" class="row g-4" method="post">
                @csrf
                <div class="form-group col-md-4">
                    <label for="plan_id">Plan</label>
                    <select id="plan_id" name="plan_id" class="form-control">
                        @foreach ($plans as $plan)
                            <option value="<?= $plan->id ?>" {{ $selectedPlan && $selectedPlan->id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->title }}: ${{ $plan->minimum }} -
                                {{ !$plan->maximum ? 'above' : "$" . $plan->maximum }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="amount">Deposit Amount</label>
                    <input class="form-control" id="amount" type="number" name="amount" required step="0.01" />
                </div>
                <div class="form-group col-md-4">
                    <label for="currency_id">Currency</label>
                    <select id="currency_id" name="currency_id" class="form-control" onchange="switch_deposit_from()">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="currency_id">Deposit From</label>
                    @foreach ($currencies as $currency)
                        <div class="deposit_from" id="currency{{ $currency->id }}" style="display:none">
                            <label>
                                <input value="balance" type="radio" name="deposit_from"
                                    {{ !$currency->deposit_from_balance ? 'disabled' : null }} required />
                                &nbsp;
                                Wallet
                                (Balance: ${{ number_format($currency->balance, 2) }})
                            </label>&nbsp;

                            <label>
                                <input value="processor" type="radio" name="deposit_from"
                                    required {{ !$currency->deposit_from_processor ? 'disabled' : null }} />
                                &nbsp; Payment Processor
                            </label>
                        </div>
                    @endforeach

                    <script>
                        function switch_deposit_from() {
                            var sel = document.getElementById("currency_id");
                            var proc = sel.options[sel.selectedIndex].value;
                            document.querySelectorAll(".deposit_from").forEach(element => {
                                element.style.display = "none";
                            });

                            if (proc) {
                                document.getElementById("currency" + proc).style.display = "block";
                            }
                        }
                        switch_deposit_from();
                    </script>
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <button type="submit" class="btn btn-primary mr-2">Make Deposit</button>
                </div>
            </form>
        </x-user.section-body>
    </x-user.section>

    <x-user.section>
        <x-user.section-title>Deposit history</x-user.section-title>
        <x-user.section-description>Below is a list of deposits you've made so far and their statuses.
        </x-user.section-description>
        <x-user.section-body>
            <form action="" class="row container p-0 mb-4" method="get">
                <div class="form-group col-sm-4 col-md-3">
                    <label for="status">Deposit Status:</label>
                    <select id="status" name="status" class="form-control">
                        <option {{ request('status', '') == '' ? 'selected' : null }} value="">Show
                            All
                        </option>
                        <option {{ request('status', '') == 'approved' ? 'selected' : null }} value="approved">Approved
                        </option>
                        <option {{ request('status', '') == 'pending' ? 'selected' : null }} value="pending">Pending
                        </option>
                        <option {{ request('status', '') == 'released' ? 'selected' : null }} value="released">Released
                        </option>
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
                        @foreach ($deposits as $index => $trans)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $trans->plan_title }}
                                    </strong>&nbsp;
                                    <small class="badge">
                                        {{ $trans->status }}
                                    </small><br />
                                    @if ($trans->status !== 'pending')
                                        <small>
                                            <strong>Started:</strong>
                                            {{ $trans->deposit_approval_date }}<br />
                                            @if (!empty($trans->last_interest_date))
                                                <strong>Expires:</strong>
                                                {{ $trans->last_interest_date }}<br />
                                            @endif
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    {{ $trans->amount }}<br />

                                </td>
                                <td class="text-danger">
                                    <a href="{{ route('user.deposits.view', ['id' => $trans->id]) }}"
                                        title="View full details">VIEW</a><br />
                                </td>
                            </tr>
                        @endforeach
                        @if (!$deposits)
                            <tr>
                                <td colspan="3">No data found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $deposits->links() }}
        </x-user.section-body>
    </x-user.section>
</x-template.user>
