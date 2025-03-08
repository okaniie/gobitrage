<x-template.admin title="Auto-Withdrawal Settings" slug="auto-withdrawal">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Auto Withdrawal Settings:</h3>
                    <form method="post" name="formsettings" onsubmit="return check_asettings()">
                        @csrf
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th>Auto-Withdrawals Status</th>
                                    <td> <select name="site_auto_withdrawal" class="inpts">
                                            <option {{ $site_auto_withdrawal == 0 ? 'selected' : '' }} value="0">
                                                Disabled</option>
                                            <option {{ $site_auto_withdrawal == 1 ? 'selected' : '' }} value="1">
                                                Enabled</option>
                                        </select> </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th colspan="2">Other Settings:</th>
                                </tr>
                                <tr>
                                    <th>Processings:</th>
                                    <td class="alert alert-danger"><a href="{{ route('admin.processings') }}"
                                            targe="_blank">Processings
                                            setup is here</a></td>
                                </tr>
                                <tr>
                                    <th>Maximal daily withdrawal for a user for all currencies:</th>
                                    <td>
                                        <div style="display: flex;width: 100%;height: 100%;">
                                            $<input type="text" name="site_auto_withdrawal_max"
                                                value="{{ $site_auto_withdrawal_max }}" class="inpts">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <center> <input type="submit" value="Save" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <br />
    <div class="alert alert-warning"> You can edit any payment processing in this section by clicking the "edit"
        link. <br><br> Any processing you add can't allow users to deposit just by themselves.
    </div>
    </x-tempe.admin>
