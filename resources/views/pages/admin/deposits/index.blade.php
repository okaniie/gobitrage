<x-template.admin title="Deposits" slug="deposits">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Deposits:</h3>
                    <form method="get">
                        <table class="form controls nosize">
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="status" class="inpts">
                                            <option {{ request('status', '') == '' ? 'selected' : '' }} value="">
                                                All Deposits
                                            </option>
                                            <option {{ request('status', '') == 'approved' ? 'selected' : '' }}
                                                value="approved">
                                                Approved</option>
                                            <option {{ request('status') == 'pending' ? 'selected' : '' }}
                                                value="pending">
                                                Pending</option>
                                            {{-- <option {{ request('status') == 'released' ? 'selected' : '' }}
                                                value="released">
                                                Released</option> --}}
                                        </select><br>
                                        <select name="crypto_currency" class="inpts">
                                        </select>
                                    </td>
                                    <td style="text-align:right;">
                                        <div style="margin-bottom:5px;">
                                            From: <input name="from" type="date" value="{{ request('from') }}" class="inpts" />
                                        </div>
                                        To: <input name="to" value="{{ request('to') }}" type="date" class="inpts" />
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
                                <th>-</th>
                            </tr>
                            @foreach ($deposits as $key => $item)
                                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                                    <td class="trn_user">
                                        <b>{{ $item->username }}</b>
                                        <br>
                                        {{ $item->plan_title }}<br />
                                        <small class="text-{{ $item->status }}">
                                            <b>{{ $item->status }}</b>
                                        </small><br />
                                        <small>{{ $item->created_at }}</small>
                                    </td>
                                    <td nowrap="" align="right" class="text-{{ $item->status }}">
                                        <b>${{ number_format($item->amount, 2) }}</b><br/>
                                        ({{ $item->crypto_currency }})
                                    </td>
                                    <td align="right">
                                        <a href="{{ route('admin.deposits.view', ['id' => $item->id]) }}"
                                            class="sbmt btn-sm btn-success" style="margin-bottom:2px;">view</a><br>
                                        @if ($item->status == 'pending')
                                            <a href="{{ route('admin.deposits.approve', ['id' => $item->id]) }}"
                                                class="sbmt btn-sm btn-info" style="margin-bottom:2px;"
                                                onclick="return confirmAction('Are you sure you want to approve this deposit? You acknowledge that you have paid this user the requested amount. Continue?')">approve</a><br />
                                            <a href="{{ route('admin.deposits.delete', ['id' => $item->id]) }}"
                                                class="sbmt btn-sm btn-danger" style="margin-bottom:2px;"
                                                onclick="return deleteRecord()">delete</a>
                                        @endif
                                        @if ($item->status == 'approved')
                                            <a href="{{ route('admin.deposits.release', ['id' => $item->id]) }}"
                                                class="sbmt btn-sm btn-info" style="margin-bottom:2px;"
                                                onclick="return confirmAction('Are you sure you want to release this deposit? The user will no longer receive further interest for this deposit. Continue?')">release</a><br />
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> <br>
                    <div style="margin-bottom: 2rem">
                        {{ $deposits->links() }}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
