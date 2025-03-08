<x-template.admin :title="'Withdrawal #' . $withdrawal->id" slug="withdrawals">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>View Withdrawal:</h3>

                    <table class="form settings">
                        <tbody>
                            <tr>
                                <th>Request Date:</th>
                                <td>
                                    {{ $withdrawal->created_at }}
                                </td>
                            </tr>
                            <tr>
                                <th>Username:</th>
                                <td>
                                    {{ $withdrawal->username }}
                                </td>

                            <tr>
                                <th>Crypto Currency:</th>
                                <td>
                                    {{ $withdrawal->crypto_currency }}
                                </td>
                            </tr>

                            <tr>
                                <th>Withdrawal Address:</th>
                                <td>{{ $withdrawal->address }}</td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td>${{ number_format($withdrawal->amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><small
                                        class="badge badge-{{ $withdrawal->status }}">{{ $withdrawal->status }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Status Link:</th>
                                <td>
                                    @if (!empty($withdrawal->status_link))
                                        <a target="_blank"
                                            href="{{ $withdrawal->status_link }}">{{ $withdrawal->status_link }}</a>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
