<x-template.admin title="Transactions" slug="transactions">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Transactions History:</h3>
                    <style>
                        .trn_user a.badge {
                            display: none;
                            text-decoration: none;
                        }

                        .trn_user:hover a.badge {
                            display: inline;
                        }
                    </style>
                    <form method="get">
                        <table class="form controls nosize">
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="log_type" class="inpts">
                                            <option {{ request()->get('log_type', '') == '' ? 'selected' : '' }}
                                                value="">All Transactions
                                            </option>
                                            <option {{ request()->get('log_type', '') == 'deposit' ? 'selected' : '' }}
                                                value="deposit">
                                                Deposit</option>
                                            <option
                                                {{ request()->get('log_type', '') == 'deposit-earning' ? 'selected' : '' }}
                                                value="deposit-earning">
                                                Deposit Earning</option>
                                            <option
                                                {{ request()->get('log_type', '') == 'deposit-release' ? 'selected' : '' }}
                                                value="deposit-release">
                                                Deposit Release</option>
                                            <option {{ request()->get('log_type', '') == 'bonus' ? 'selected' : '' }}
                                                value="bonus">Bonus
                                            </option>
                                            <option {{ request()->get('log_type', '') == 'penalty' ? 'selected' : '' }}
                                                value="penalty">
                                                Penalty</option>
                                            <option {{ request()->get('log_type', '') == 'earning' ? 'selected' : '' }}
                                                value="earning">
                                                Earning</option>
                                            <option
                                                {{ request()->get('log_type', '') == 'withdrawal' ? 'selected' : '' }}
                                                value="withdrawal">Withdrawal</option>
                                            <option {{ request()->get('log_type', '') == 'referral' ? 'selected' : '' }}
                                                value="referral">
                                                Referral commission</option>
                                        </select><br>
                                    </td>
                                    <td style="text-align:right;">
                                        <div style="margin-bottom:5px;">From:
                                            <input name="from" type="date" value="{{ old('from') }}"
                                                class="inpts" />
                                        </div>
                                        To: <input name="to" type="date" class="inpts" />
                                    </td>
                                    <td style="text-align:right"> Per Page:
                                        <select name="rpp" class="inpts nosize">
                                            <option {{ request('rpp', '') == '20' ? 'selected' : '' }}>
                                                20
                                            </option>
                                            <option {{ request('rpp', '') == '50' ? 'selected' : '' }}>
                                                50
                                            </option>
                                            <option {{ request('rpp', '') == '100' ? 'selected' : '' }}>
                                                100
                                            </option>
                                        </select> <br />
                                        <input type="submit" value="Go" class="sbmt">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <table class="list">
                        <tbody>
                            <tr>
                                <th>UserName</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            @foreach ($transactions as $key => $item)
                                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                                    <td class="trn_user">
                                        <b>{{ $item->username }}</b>
                                        <a class="badge badge-danger" target="_blank"
                                            href="{{ route('admin.users.view', ['id' => $item->user_id]) }}">edit</a>
                                        <a class="badge badge-info" target="_blank"
                                            href="{{ route('admin.users.funds', ['id' => $item->user_id]) }}">manage</a>
                                        <br>
                                        <small style="color:gray"><b>{{ $item->log_type }}:</b>
                                            &nbsp;{{ $item->transaction_details }}</small>
                                    </td>
                                    <td nowrap="" align="right" class="text-{{ $item->log_type }}">
                                        <b>${{ number_format($item->amount, 2) }}</b><br />
                                        ({{ $item->crypto_currency }})
                                    </td>
                                    <td align="center"><small>{{ $item->created_at }}</small></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> <br>
                    {{ $transactions->links() }}
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
