<x-template.user :title="'Deposit #' . $deposit->id" slug="deposits">
    <x-user.page-banner>Deposit #{{ $deposit->id }}</x-user.page-banner>
    <x-general.flash-bag />
    <x-user.section>
        <x-user.section-title>Deposit Details</x-user.section-title>
        <x-user.section-description>
            Here are the details of this deposit.
        </x-user.section-description>
        <x-user.section-body>
            <div class="row g-3">
                @if ($deposit->status == 'pending')
                    @if ($deposit->qrcode_link)
                        <div class="text-center">
                            <p>
                                <img src="{{ $deposit->qrcode_link }}" alt="{{ $deposit->cryto_currency }}" />
                            </p>
                            <strong>Scan this code to complete payment.</strong>
                        </div>
                        <hr />
                    @endif
                    @if ($deposit->payment_link)
                        <div class="text-center">
                            <a class="btn btn-primary" target="_blank" href="{{ $deposit->payment_link }}">Click here to
                                make payment.</a>
                        </div>
                        <hr />
                    @endif
                @endif
                @if($deposit->payment_link)
                <div class="form-group col-md-4">
                    <label>Payment Link</label>
                    <input class="form-control" readonly value="{{ $deposit->payment_link ?? '' }}" />
                </div>
                @endif
                @if(false)
                <div class="form-group col-md-4">
                    <label>QRCode Link</label>
                    <input class="form-control" readonly value="{{ $deposit->qrcode_link ?? '' }}" />
                </div>
                @endif
                @if($deposit->status_link)
                <div class="form-group col-md-4">
                    <label>Status Link</label>
                    <input class="form-control" readonly value="{{ $deposit->status_link ?? '' }}" />
                </div>
                @endif
                @if ($deposit->status != 'pending')
                    <div class="form-group col-md-4">
                        <label>Transaction ID</label>
                        <input class="form-control" readonly value="{{ $deposit->transaction_id }}" />
                    </div>
                @else
                    <div class="form-group col-md-4">
                        <label>Deposit Address</label>
                        <input class="form-control" readonly value="{{ $deposit->address }}" />
                    </div>
                @endif
                <div class="form-group col-md-4">
                    <label>User Name</label>
                    <input class="form-control" readonly value="{{ $deposit->username }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Plan</label>
                    <input class="form-control" readonly value="{{ $deposit->plan_title }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Principal Return</label>
                    <input class="form-control" readonly value="Yes" />
                </div>
                <div class="form-group col-md-4">
                    <label>Principal Withdrawal</label>
                    <input class="form-control" readonly value="On Maturity" />
                </div>
                <div class="form-group col-md-4">
                    <label>Credit Amount</label>
                    <input class="form-control" readonly value="${{ $deposit->amount }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Deposit Fees</label>
                    <input class="form-control" readonly value="${{ $deposit->charges }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Deposit Amount</label>
                    <input class="form-control" readonly value="${{ $deposit->amount + $deposit->charges }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Payment Method</label>
                    <input class="form-control" readonly value="{{ $deposit->crypto_currency }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Payment Amount</label>
                    <input class="form-control" readonly value="{{ $deposit->amount }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Deposit Status</label>
                    <input class="form-control" readonly value="{{ $deposit->status }}" />
                </div>
            </div>
        </x-user.section-body>
    </x-user.section>

    <x-user.section>
        <x-user.section-title>Deposit #{{ $deposit->id }} logs</x-user.section-title>
        <x-user.section-description>
            Below is a log of transactions related to this deposit.
        </x-user.section-description>
        <x-user.section-body>
            <x-user.transactions-log :transactions="$transactions" />
        </x-user.section-body>
    </x-user.section>
</x-template.user>
