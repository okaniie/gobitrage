<x-template.admin title="Edit User" slug="users">
    <script type="text/javascript" src="nicEdit.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            nicEditors.allTextAreas({
                fullPanel: true
            })
        });
    </script>

    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Edit User:</h3>
                    <form method="post">
                        @csrf
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th>Full Name:</th>
                                    <td><input type="text" name="profile[name]" value="{{ $user->name }}"
                                            class="inpts" size="30"></td>
                                </tr>
                                <tr>
                                    <th>Username:</th>
                                    <td><input type="text" name="profile[username]" value="{{ $user->username }}"
                                            class="inpts" size="30"></td>
                                </tr>
                                <tr>
                                    <th>E-mail:</th>
                                    <td><input type="text" name="profile[email]" value="{{ $user->email }}"
                                            class="inpts" size="30">
                                    </td>
                                </tr>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <th>{{ $address->currency_code }} Withdraw. Address:</th>
                                        <td><input type="text" name="address[{{ $address->currency_code }}]"
                                                value="{{ $address->deposit_address }}" class="inpts"></td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th>Secret Question:</th>
                                    <td><input type="text" name="profile[secret_question]"
                                            value="{{ $user->secret_question }}" class="inpts"></td>
                                </tr>
                                <tr>
                                    <th>Secret Answer:</th>
                                    <td><input type="text" name="profile[secret_answer]"
                                            value="{{ $user->secret_answer }}" class="inpts">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Auto Withdrawal:</th>
                                    <td> <select name="profile[auto_withdrawal]" class="inpts">
                                            <option {{ $user->auto_withdrawal == '1' ? 'selected' : '' }}
                                                value="1">Enabled
                                            </option>
                                            <option {{ $user->auto_withdrawal == '0' ? 'selected' : '' }}
                                                value="0">Disabled
                                            </option>
                                        </select> </td>
                                </tr>
                                <tr>
                                    <th>New Password:</th>
                                    <td><input type="text" name="profile[password]" value="" class="inpts"
                                            size="30"></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td><select name="profile[status]" class="inpts">
                                            <option {{ $user->status == '1' ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $user->status == '0' ? 'selected' : '' }} value="0">
                                                Inactive
                                            </option>
                                        </select> </td>
                                </tr>
                            </tbody>
                        </table> <br>
                        <center> <input type="submit" value="Save" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

</x-template.admin>
