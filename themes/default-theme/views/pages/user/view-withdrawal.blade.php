<x-template.user :title="'Withdrawal #' . $withdrawal->id" slug="withdrawals">
    <x-user.page-banner>Withdrawal #{{ $withdrawal->id }}</x-user.page-banner>
    <x-general.flash-bag />
    <x-user.section>
        <x-user.section-title>Withdrawal Details</x-user.section-title>
        <x-user.section-description>
            Here are the details of this withdrawal.
        </x-user.section-description>
        <x-user.section-body>
            <div class="row g-3">
                <div class="form-group col-md-4">
                    <label>Withdrawal Request Date</label>
                    <input class="form-control" readonly value="{{ $withdrawal->created_at }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>User Name</label>
                    <input class="form-control" readonly value="{{ $withdrawal->username }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Payment Method</label>
                    <input class="form-control" readonly value="{{ $withdrawal->crypto_currency }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Withdrawal Address</label>
                    <input class="form-control" readonly value="{{ $withdrawal->address }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Amount Requested</label>
                    <input class="form-control" readonly value="{{ $withdrawal->amount }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Withdrawal Charges</label>
                    <input class="form-control" readonly value="{{ $withdrawal->charges }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Withdrawal Status</label>
                    <input class="form-control" readonly value="{{ $withdrawal->status }}" />
                </div>
                <div class="form-group col-md-4">
                    <label>Withdrawal Status Link</label>
                    @if (!empty($withdrawal->status_link))
                        <a target="_blank" class="form-control" href="{{ $withdrawal->status_link }}">{{ $withdrawal->status_link }}</a>
                    @else
                        <input class="form-control" readonly value="" />
                    @endif
                </div>
            </div>
        </x-user.section-body>
    </x-user.section>
</x-template.user>
