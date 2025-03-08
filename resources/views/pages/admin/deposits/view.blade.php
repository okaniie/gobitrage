<x-template.admin :title="'Deposit #' . $deposit->id" slug="deposits">

    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>View Deposit:</h3>

                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Transaction ID:</th>
                                <td>
                                    {{ $deposit->transaction_id }}
                                </td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td>
                                    {{ $deposit->username }}
                                </td>
                            </tr>
                            <tr>
                                <th>Plan:</th>
                                <td>{{ $deposit->plan_title }}</td>
                            </tr>

                            <tr>
                                <th>Credit Amount:</th>
                                <td>${{ number_format($deposit->amount, 2) }}</td>
                            </tr>

                            <tr>
                                <th>Deposit Amount:</th>
                                <td>${{ number_format($deposit->amount, 2) }}</td>
                            </tr>

                            <tr>
                                <th>Payment Method:</th>
                                <td>{{ $deposit->crypto_currency }}</td>
                            </tr>

                            <tr>
                                <th>Payment Amount:</th>
                                <td>{{ $deposit->crypto_amount }}</td>
                            </tr>
                            <tr>
                                <th>Deposit Status:</th>
                                <td><small class="badge badge-{{ $deposit->status }}">{{ $deposit->status }}</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
