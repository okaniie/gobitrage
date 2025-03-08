<x-template.user title="Referrals" slug="referrals">
    <x-user.page-banner>Referrals</x-user.page-banner>
    <x-user.section>
        <x-user.section-title>Referral stats</x-user.section-title>
        <x-user.section-description>
            Here are your referral stats and your invite link. Share it to earn referral bonuses.
        </x-user.section-description>
        <x-user.section-body>
            <div class="row g-4">
                <div class="form-group col-md-10">
                    <label for="referral_link">Referral Link</label>
                    <input class="form-control" id="referral_link" value="<?= $referral_link ?>" />
                </div>
                <div class="form-group col-sm-12 col-md-2 d-flex flex-column">
                    <div class="flex-grow-1"></div>
                    <button class="btn btn-primary" onclick="copyLink()">click to copy</button></small>
                </div>

                <div class="form-group col-sm-6">
                    <label for="amount">Total Referrals</label>
                    <input class="form-control" readonly value="<?= $referral_overview['total_referrals'] ?>">
                </div>
                <div class="form-group col-sm-6">
                    <label for="amount">Referral Commission Earned</label>
                    <input class="form-control" readonly
                        value="$<?= $referral_overview['total_referral_commission'] ?>" />
                </div>
            </div>
        </x-user.section-body>
    </x-user.section>

    <x-user.section>
        <x-user.section-title>Referrals history</x-user.section-title>
        <x-user.section-description>
            Below is a list of your referrals.
        </x-user.section-description>
        <x-user.section-body>
            <form class="row container p-0 mb-4 g-3" method="get">
                <div class="form-group col-sm-4 col-md-3">
                    <label for="query">Referral Username:</label>
                    <input class="form-control" type="text" id="query" name="query"
                        value="{{ old('query') }}" />
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
                    <button type="submit" class="btn btn-block btn-danger">Go</button>
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
                        @if ($referrals)
                            @foreach ($referrals as $trans)
                                <tr>
                                    <td style="line-height:1.5">
                                        <strong>
                                            {{ $trans->referred_username }}
                                        </strong><br />
                                        <strong>Referred by:</strong>
                                        {{ $trans->referral_username }}<br />
                                        <strong>Date:</strong>
                                        {{ $trans->created_at }}<br />
                                    </td>
                                    <td>
                                        ${{ $trans->referral_bonus }}<br />
                                    </td>
                                    <td>
                                        <a href="{{ route('user.referrals.view', ['id' => $trans->id]) }}"
                                            title="View full details" class="btn btn-primary btn-sm"><i
                                                class="icon-eye"></i></a><br />
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

            {{ $referrals->links() }}

        </x-user.section-body>
    </x-user.section>

    <script>
        function copyLink() {
            /* Get the text field */
            var copyText = document.getElementById("referral_link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Referral Link Copied");

            return false;
        }
    </script>
</x-template.user>
