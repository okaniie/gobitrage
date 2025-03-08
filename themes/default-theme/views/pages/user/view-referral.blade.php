<x-template.user :title="'Referral #' . $referral->id" slug="referrals">
    <x-user.page-banner>Referral #{{ $referral->id }}</x-user.page-banner>
    <x-general.flash-bag />
    <x-user.section>
        <x-user.section-title>Referral Details</x-user.section-title>
        <x-user.section-description>
            Here are the details of this referral.
        </x-user.section-description>
        <x-user.section-body>
            <div class="row g-3">
                <div class="form-group col-md-4">
                    <label>Referrer</label>
                    <input class="form-control" readonly value="<?= $referral->referral_username ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label>Referred</label>
                    <input class="form-control" readonly value="<?= $referral->referred_username ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label>Referral Bonus</label>
                    <input class="form-control" readonly value="<?= $referral->referral_bonus ?>" />
                </div>
            </div>
        </x-user.section-body>
    </x-user.section>
    <x-user.section>
        <x-user.section-title>Referral #{{ $referral->referred_username }}</x-user.section-title>
        <x-user.section-description>
            Below is a log of transactions related to this referral.
        </x-user.section-description>
        <x-user.section-body>
            <x-user.transactions-log :transactions="$transactions" />
        </x-user.section-body>
    </x-user.section>
</x-template.user>
