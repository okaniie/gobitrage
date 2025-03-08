<x-template.admin title="Plans" slug="plans">
    <h3>Investment Packages</h3>

    <table class="list" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tbody>

            <tr>
                <th><b>Package name</b></th>
                <th><b>Category</b></th>
                <th><b>Deposit (US$)</b></th>
                <th><b>Details</b></th>
                <th><b>-</b></th>
            </tr>
            @foreach ($plans as $key => $plan)
                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                    <td><strong class="font-18">
                            {{ $plan->title }}<br />
                        </strong>
                        @if ($plan->has_badge == 1)
                            <small class="badge badge-approved">Featured</small>
                        @endif
                    </td>
                    <td>
                        {{ $plan->plan_category()->first()['title'] }}
                    </td>
                    <td>
                        ${{ number_format($plan->minimum, 2) }} -
                        {{ $plan->maximum == 0 ? 'above' : '$' . number_format($plan->maximum, 2) }}
                    </td>
                    <td>
                        {{ $plan->percentage }}%
                        {{ $plan->profit_frequency === 'end' ? 'ROI at end of plan' : $plan->profit_frequency . ' ROI' }}
                        <br />
                        {{ $plan->duration }} {{ $plan->duration_type }} duration
                        <br />
                        {{ $plan->referral_percentage }}% referral commission
                    </td>
                    <td class="menutxt" bgcolor="FFF9B3" align="right">
                        <a href="{{ route('admin.plans.view', ['id' => $plan->id]) }}">[edit]</a>
                        <a href="{{ route('admin.plans.delete', ['id' => $plan->id]) }}"
                            onclick="return deleteRecord()">[delete]</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br />

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td>
                    <form method="get" action="{{ route('admin.plans.view', ['id' => 'new']) }}">
                        <input type="submit" value="Add a new Investment Package" class="sbmt" size="15">
                    </form>
                </td>
                <td align="right">
                </td>
            </tr>
        </tbody>
    </table>

    <br />

    <div class="alert alert-warning"> Investment packages:<br>
        You can create unlimited sets of investment packages with any settings.<br><br>
        Here you can view, edit and delete your packages and plans.
    </div>

</x-template.admin>
