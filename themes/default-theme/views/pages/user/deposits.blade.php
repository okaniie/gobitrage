<x-template.user title="Deposits" slug="deposits">
    <x-user.page-banner>Deposits</x-user.page-banner>
    <x-general.flash-bag />
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card bg-dark border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="text-white mb-0">Make a Deposit</h5>
                        <p class="text-muted mb-0">Fill out the form below to make a new deposit now.</p>
                    </div>
                    <div class="card-body">
                        <form id="new_deposit" class="row g-4" method="post">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="plan_id" class="text-white">Plan</label>
                                <select id="plan_id" name="plan_id" class="form-control bg-dark text-white border-secondary">
                                    @foreach ($plans as $plan)
                                        <option value="<?= $plan->id ?>" {{ $selectedPlan && $selectedPlan->id == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->title }}: ${{ $plan->minimum }} -
                                            {{ !$plan->maximum ? 'above' : "$" . $plan->maximum }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amount" class="text-white">Deposit Amount</label>
                                <input class="form-control bg-dark text-white border-secondary" id="amount" type="number" name="amount" required step="0.01" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="currency_id" class="text-white">Currency</label>
                                <select id="currency_id" name="currency_id" class="form-control bg-dark text-white border-secondary" onchange="switch_deposit_from()">
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-white">Deposit From</label>
                                @foreach ($currencies as $currency)
                                    <div class="deposit_from" id="currency{{ $currency->id }}" style="display:none">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" value="balance" type="radio" name="deposit_from"
                                                {{ !$currency->deposit_from_balance ? 'disabled' : null }} required />
                                            <label class="form-check-label text-white">
                                                Wallet (Balance: ${{ number_format($currency->balance, 2) }})
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="processor" type="radio" name="deposit_from"
                                                required {{ !$currency->deposit_from_processor ? 'disabled' : null }} />
                                            <label class="form-check-label text-white">
                                                Payment Processor
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <button type="submit" class="btn btn-primary">Make Deposit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card bg-dark border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="text-white mb-0">Deposit History</h5>
                        <p class="text-muted mb-0">Below is a list of deposits you've made so far and their statuses.</p>
                    </div>
                    <div class="card-body">
                        <form action="" class="row g-4 mb-4" method="get">
                            <div class="form-group col-sm-4 col-md-3">
                                <label for="status" class="text-white">Deposit Status:</label>
                                <select id="status" name="status" class="form-control bg-dark text-white border-secondary">
                                    <option {{ request('status', '') == '' ? 'selected' : null }} value="">Show All</option>
                                    <option {{ request('status', '') == 'approved' ? 'selected' : null }} value="approved">Approved</option>
                                    <option {{ request('status', '') == 'pending' ? 'selected' : null }} value="pending">Pending</option>
                                    <option {{ request('status', '') == 'released' ? 'selected' : null }} value="released">Released</option>
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
                                    @foreach ($deposits as $index => $trans)
                                        <tr>
                                            <td>
                                                <strong>{{ $trans->plan_title }}</strong>
                                                <span class="badge bg-{{ $trans->status === 'pending' ? 'warning' : ($trans->status === 'approved' ? 'success' : 'info') }} ms-2">
                                                    {{ ucfirst($trans->status) }}
                                                </span>
                                                @if ($trans->status !== 'pending')
                                                    <div class="mt-2">
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i> Started: {{ $trans->deposit_approval_date }}
                                                        </small>
                                                        @if (!empty($trans->last_interest_date))
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="fas fa-calendar-times me-1"></i> Expires: {{ $trans->last_interest_date }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-primary">{{ $trans->amount }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.deposits.view', ['id' => $trans->id]) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (!$deposits)
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No deposits found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $deposits->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</x-template.user>
