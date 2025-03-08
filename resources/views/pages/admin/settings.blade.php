<x-template.admin title="Settings" slug="settings">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Main Settings:</h3>
                    <form autocomplete="off" method="post" action="{{ route('admin.settings.update') }}">
                        @csrf
                        <table class="form settings">
                            <tbody>
                                <tr>
                                    <th colspan="2">Other Settings:</th>
                                </tr>
                                <tr>
                                    <th>Active Currencies:</th>
                                    <td>
                                        <a href="{{ route('admin.processings') }}">Update Currencies</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Minimum Withdraw Amount:</th>
                                    <td><input type="text" name="min_withdrawal"
                                            value="{{ $settings['min_withdrawal'] }}" class="inpts"></td>
                                </tr>
                                <tr>
                                    <th>Pay Referral Bonus:</th>
                                    <td>
                                        <select name="pay_referral" class="inpts">
                                            <option {{ $settings['pay_referral'] == '0' ? 'selected' : '' }}
                                                value="0">No
                                            </option>
                                            <option {{ $settings['pay_referral'] == '1' ? 'selected' : '' }}
                                                value="1">Yes
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Google Track ID:</th>
                                    <td><input type="text" name="google_track_id" autocomplete="off"
                                            value="{{ $settings['google_track_id'] }}" class="inpts"></td>
                                </tr>
                                <tr>
                                    <th>Header Code:</th>
                                    <td>
                                        <textarea rows=5 name="header_code" class="inpts">{{ $settings['header_code'] }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Footer Code:</th>
                                    <td>
                                        <textarea rows=5 name="footer_code" class="inpts">{{ $settings['footer_code'] }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Enter Password:</th>
                                    <td><input type="password" name="password" class="inpts" autocomplete="false"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-warning">
                                            <strong>Active Currencies:</strong> The active currencies
                                            will be seen by the users when they want to make payment. Please make sure
                                            you
                                            fill the address of currencies you want to be active.<br />
                                            <strong>Google Track ID:</strong> ID for google analytics.<br />
                                            <strong>Header Code:</strong> Enter chat app codes that need to be in the
                                            head
                                            section of the page.<br />
                                            <strong>Footer Code:</strong> Enter chat app codes or any other code that
                                            needs
                                            to be before the closing html tag.
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <center> <input type="submit" value="Update" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
