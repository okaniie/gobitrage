<x-template.admin title="Withdrawals" slug="withdrawals">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Withdrawals:</h3>
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
                                        <select name="status" class="inpts">
                                            <option {{ request('status', '') == '' ? 'selected' : '' }} value="">
                                                All
                                                Withdrawals
                                            </option>
                                            <option {{ request('status', '') == 'approved' ? 'selected' : '' }}
                                                value="approved">Approved</option>
                                            <option {{ request('status', '') == 'pending' ? 'selected' : '' }}
                                                value="pending">
                                                Pending</option>
                                            <option {{ request('status', '') == 'declined' ? 'selected' : '' }}
                                                value="declined">
                                                Declined</option>
                                        </select><br>
                                        <select name="cryptoCurrency" class="inpts">
                                        </select>
                                    </td>
                                    <td style="text-align:right;">
                                        <div style="margin-bottom:5px;">From: <input name="from" type="date"
                                                value="{{ old('from') }}" class="inpts" /></div>
                                        To: <input name="to" type="date" class="inpts"
                                            value="{{ old('to') }}" />
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
                            @foreach ($withdrawals as $key => $item)
                                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                                    <td class="trn_user">
                                        <b>{{ $item->username }}</b>
                                        <br>
                                        <small class="text-{{ $item->status }}">
                                            <b>{{ $item->status }}</b>
                                            &nbsp;{{ $item->transaction_details }}
                                        </small><br />
                                        <small>{{ $item->created_at }}</small>
                                    </td>
                                    <td nowrap="" align="right" class="text-{{ $item->status }}">
                                        <b>${{ number_format($item->amount, 2) }}</b><br />
                                        ({{ $item->crypto_currency }})
                                    </td>
                                    <td align="right">
                                        <a href="{{ route('admin.withdrawals.view', ['id' => $item->id]) }}"
                                            class="sbmt btn-sm btn-success" style="margin-bottom:2px;">view</a><br>
                                        @if ($item->status == 'pending')
                                            <a href="{{ route('admin.withdrawals.approve', ['id' => $item->id]) }}"
                                                class="sbmt btn-sm btn-info" style="margin-bottom:2px;"
                                                onclick="return confirmAction('Are you sure you want to approve this withdrawal? You acknowledge that you have paid this user the requested amount. Continue?')">approve</a><br />
                                            <a data-href="{{ route('admin.withdrawals.decline', ['id' => $item->id]) }}"
                                                class="sbmt btn-sm btn-warning"
                                                style="margin-bottom:2px; background:yellow"
                                                onclick="return confirmDecline()">decline</a><br />
                                            <a href="{{ route('admin.withdrawals.delete', ['id' => $item->id]) }}"
                                                class="sbmt btn-sm btn-danger" style="margin-bottom:2px;"
                                                onclick="return deleteRecord()">delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> <br>
                    {{ $withdrawals->links() }}
                </td>
            </tr>
        </tbody>
    </table>
    <script>
        function confirmDecline() {

            var prompt = window.prompt("Enter reason for decline.");

            if (!prompt) {
                alert("You must enter a reason to decline a withdrawal.");
                return false;
            }

            var url = event.target.getAttribute('data-href') + "?message=" + window.encodeURI(prompt);

            window.location.href = url;

            return false;
        }
    </script>
</x-template.admin>
