<x-template.admin title="Subtract Penalty" slug="users">

    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Subtract Penalty:</h3>

                    <form method="post" action="{{ route('admin.users.penalty.add', ['id' => $user->id]) }}">
                        @csrf
                        <table class="form settings">
                            <tbody>
                                <tr>
                                    <th>Full Name:</th>
                                    <td>
                                        {{ $user->name }}
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
                                    <td>$ <input type="number" name="amount" class="inpts"></td>
                                </tr>
                                <tr>
                                    <th>Wallet:</th>
                                    <td>
                                        <select name="currency_code" class="inpts">
                                            @foreach ($wallets as $wallet)
                                                <option value="{{ $wallet->currency_code }}">{{ $wallet->currency_code }} (${{$wallet->balance}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Message to User</th>
                                    <td>
                                        <textarea name="message" class="inpts"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <label><input type="checkbox" name="notify" value="1"> Notify user by
                                            email for
                                            this transaction.</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-warning"> Subtract Penalty: Enter the details of the
                                            penalty. A link
                                            will be sent to admin email to confirm transaction.<br>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <center> <input type="submit" value="subtract penalty" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>