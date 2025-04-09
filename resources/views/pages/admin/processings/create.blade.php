<x-template.admin title="Create Processing" slug="processings">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Create New Processing:</h3>
                    <form method="post" action="{{ route('admin.processings.store') }}">
                        @csrf
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th>Display Name:</th>
                                    <td>
                                        <input type="text" name="display_name" class="inpts" size="30" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Code:</th>
                                    <td>
                                        <input type="text" name="code" class="inpts" size="30" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <select name="status" class="inpts">
                                            <option value="1">On</option>
                                            <option value="0">Off</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deposit From Balance:</th>
                                    <td>
                                        <select name="deposit_from_balance" class="inpts">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deposit From Processor:</th>
                                    <td>
                                        <select name="deposit_from_processor" class="inpts">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deposit Processor:</th>
                                    <td>
                                        <input type="text" name="deposit_processor" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deposit Address:</th>
                                    <td>
                                        <input type="text" name="deposit_address" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min Deposit ($):</th>
                                    <td>
                                        <input type="text" name="deposit_min" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Max Deposit ($):</th>
                                    <td>
                                        <input type="text" name="deposit_max" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deposit Fees (%):</th>
                                    <td>
                                        <input type="text" name="deposit_fees_percentage" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Additional Deposit Fee ($):</th>
                                    <td>
                                        <input type="text" name="deposit_fees_additional" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min Deposit Fee ($):</th>
                                    <td>
                                        <input type="text" name="deposit_fees_min" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Max Deposit Fee ($):</th>
                                    <td>
                                        <input type="text" name="deposit_fees_max" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Withdrawal Processor:</th>
                                    <td>
                                        <input type="text" name="withdrawal_processor" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min Withdrawal ($):</th>
                                    <td>
                                        <input type="text" name="withdrawal_min" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Max Withdrawal ($):</th>
                                    <td>
                                        <input type="text" name="withdrawal_max" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Withdrawal Fees (%):</th>
                                    <td>
                                        <input type="text" name="withdrawal_fees_percentage" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Additional Withdrawal Fee ($):</th>
                                    <td>
                                        <input type="text" name="withdrawal_fees_additional" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min Withdrawal Fee ($):</th>
                                    <td>
                                        <input type="text" name="withdrawal_fees_min" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Max Withdrawal Fee ($):</th>
                                    <td>
                                        <input type="text" name="withdrawal_fees_max" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Auto Withdrawal:</th>
                                    <td>
                                        <select name="auto_withdrawal" class="inpts">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min Auto Withdrawal ($):</th>
                                    <td>
                                        <input type="text" name="auto_withdrawal_min" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Max Auto Withdrawal ($):</th>
                                    <td>
                                        <input type="text" name="auto_withdrawal_max" class="inpts" size="30">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <center>
                            <input type="submit" value="Create" class="btn btn-success sbmt">
                            <a href="{{ route('admin.processings') }}" class="btn btn-warning sbmt">Cancel</a>
                        </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>