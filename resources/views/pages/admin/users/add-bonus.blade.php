<x-template.admin title="Add Bonus" slug="users">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Add Bonus:</h3>

                    <form method="post" action="{{ route('admin.users.bonus.add', ['id' => $user->id]) }}">
                        @csrf
                        <table class="form settings">
                            <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td>
                                        <?= $user->name ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Username:</th>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Amount:</th>
                                    <td>$ <input  type="number" name="amount" class="inpts" width="30px"></td>
                                </tr>
                                <tr>
                                    <th>Currency:</th>
                                    <td>
                                        <select name="currency_code" class="inpts">
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->code }}">{{ $currency->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bonus Usage:</th>
                                    <td>
                                        <select id="usage" name="type" class="inpts">
                                            <option value="balance" selected>Add to available balance</option>
                                            <option value="invest">Use as new investment</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="planContainer" style="display:none">
                                    <th>Investment:</th>
                                    <td>
                                        <select name="plan_id" class="inpts">
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">
                                                    {{ $plan->title }} (${{ $plan->minimum }} -
                                                    {{ $plan->maximum ? '$' . $plan->maximum : 'above' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <label><input type="checkbox" value="1" name="notify"> Notify user by email for
                                            this transaction.</label><br />
                                        <label id="payReferralCheckbox" style="display:none">
                                            <input type="checkbox" value="1" name="pay_referral"> Pay referral commission
                                            to upliner if
                                            transaction is eligible and referral bonus payment is turned on in
                                            settings.</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-warning"> Add Bonus: Enter the details of the bonus. A
                                            link
                                            will be sent to admin email to confirm transaction.<br>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <center> <input type="submit" value="add bonus" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <script type="text/javascript">
        function usageMonitor() {
            var usage = document.querySelector('#usage').value;

            if (usage == "invest") {
                document.querySelector('#planContainer').style.display = "contents";
                document.querySelector('#payReferralCheckbox').style.display = "contents";
            } else {
                document.querySelector('#planContainer').style.display = "none";
                document.querySelector('#payReferralCheckbox').style.display = "none";
            }
        }

        document.querySelector('#usage').addEventListener('change', usageMonitor);
    </script>

</x-template.admin>
