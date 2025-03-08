<x-template.admin title="Referrals" slug="referrals">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Referrals:</h3>
                    <form method="get">
                        <table class="form controls nosize">
                            <tbody>
                                <tr>
                                    <td>
                                        <input name="query" class="inpts nosize" placeholder="Search query"
                                            value="{{ request('query') }}" size="30" /><br>
                                        <select name="crypto_currency" class="inpts" style="width:190px">
                                        </select>
                                    </td>
                                    <td style="text-align:right;">
                                        <div style="margin-bottom:5px;">
                                            From: <input name="from" type="date" value="{{ old('from') }}"
                                                class="inpts" /></div>
                                        To: <input name="to" value="{{ old('to') }}" type="date"
                                            class="inpts" />
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
                                <th>Amount Earned</th>
                            </tr>
                            @foreach ($referrals as $key => $item)
                                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                                    <td class="trn_user">
                                        <b>{{ $item->referred_username }}</b>
                                        <br>
                                        <small class="">
                                            <b>Referred By: {{ $item->referral_username }}</b>
                                        </small><br />
                                        <small>{{ $item->created_at }}</small>
                                    </td>
                                    <td nowrap="" align="right" class="strong">
                                        <b>${{ number_format($item->referral_bonus, 2) }}</b>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> <br>
                    {{ $referrals->links() }}
                </td>
            </tr>
        </tbody>
    </table>
    </x-tempe.admin>
