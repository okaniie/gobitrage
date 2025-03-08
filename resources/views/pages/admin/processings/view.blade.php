<x-template.admin :title="'Processing #' . $currency->id" slug="processings">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Editing {{ $currency->display_name }} Options:</h3>
                    <form method="post">
                        @csrf
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th> {{ $currency->code }} Processing: </th>
                                    <td> {{ $currency->display_name }} <i>({{ $currency->id }})</i> </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td> <select name="currency[status]" class="inpts">
                                            <option {{ $currency->status == 0 ? 'selected' : '' }} value="0">Off
                                            </option>
                                            <option {{ $currency->status == 1 ? 'selected' : '' }} value="1">On
                                            </option>
                                        </select> </td>
                                </tr>
                            </tbody>
                        </table>
                        <h3>Deposit:</h3>
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th>Accept Deposits From:</th>
                                    <td>
                                        <label>
                                            <input value="1" type="checkbox"
                                                {{ $currency->deposit_from_balance == '1' ? 'checked' : '' }}
                                                name="currency[deposit_from_balance]"> Wallet Balance
                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label>
                                            <input value="1" type="checkbox"
                                                {{ $currency->deposit_from_processor == '1' ? 'checked' : '' }}
                                                name="currency[deposit_from_processor]"> Payment Processor
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Processing:</th>
                                    <td><select name="currency[deposit_processor]" class="inpts"
                                            onchange="deposit_open_payment_settings()" id="deposit_select">
                                            <option value="">None</option>
                                            @foreach ($deposit as $dep)
                                                <option
                                                    {{ $currency->deposit_processor == $dep['meta_data']->code ? 'selected' : '' }}
                                                    value="{{ $dep['meta_data']->code }}">
                                                    {{ $dep['meta_data']->displayName }}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        @foreach ($deposit as $dep)
                                            <table class="form deposit_settings psettings"
                                                id="deposit_settings_{{ $dep['meta_data']->code }}"
                                                style="display: none;">
                                                <tbody>
                                                    @foreach ($dep['deposit_fields'] as $field)
                                                        <tr>
                                                            <th>{{ $field['display_name'] }}:</th>
                                                            <td>
                                                                @if ($field['type'] == 'text')
                                                                    <input type="text"
                                                                        name="settings[{{ $field['field_name'] }}]"
                                                                        value="{{ $field['value'] }}"
                                                                        title="{{ $field['display_name'] }}"
                                                                        class="inpts" size="30">
                                                                @endif
                                                                @if ($field['type'] == 'checkbox')
                                                                    <input type="checkbox"
                                                                        name="settings[{{ $field['field_name'] }}]"
                                                                        value="{{ $field['value'] }}"
                                                                        title="{{ $field['display_name'] }}"
                                                                        class="inpts">
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="alert alert-warning">
                                                                {!! $dep['deposit_instructions'] !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endforeach
                                    </td>
                                </tr>
                                <script>
                                    function deposit_open_payment_settings() {
                                        var sel = document.getElementById("deposit_select");
                                        var proc = sel.options[sel.selectedIndex].value;
                                        document.querySelectorAll(".deposit_settings").forEach(element => {
                                            element.style.display = "none";
                                        });

                                        if (proc) {
                                            document.getElementById("deposit_settings_" + proc).style.display = "table";
                                        }
                                    }
                                    deposit_open_payment_settings();
                                </script>
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-warning"> Select a processing for
                                            {{ $currency->display_name }} deposits <br>
                                            <b>login as a user and try deposit to test settings.</b><br>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ $currency->code }} Fallback Address:</th>
                                    <td>
                                        <input type="text" name="currency[deposit_address]" class="inpts"
                                            id="deposit_address" size="30"
                                            value="{{ $currency->deposit_address }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-warning"> Address that will be used to process deposits
                                            if autodeposit doesnt work or is turned off.<br>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="form nosize">
                            <tbody>
                                <tr>
                                    <th class="title" colspan="4">Deposit Limits:</th>
                                </tr>
                                <tr>
                                    <th>Min ($)</th>
                                    <td><input type="text" name="currency[deposit_min]" class="inpts nosize"
                                            value="{{ $currency->deposit_min }}">
                                    </td>
                                    <th>Max ($)</th>
                                    <td><input type="text" name="currency[deposit_max]" class="inpts nosize"
                                            value="{{ $currency->deposit_max }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="title" colspan="4">Deposit Fees:</th>
                                </tr>
                                <tr>
                                    <th>Fee (%)</th>
                                    <td><input type="text" name="currency[deposit_fees_percentage]"
                                            class="inpts nosize" value="{{ $currency->deposit_fees_percentage }}">
                                    </td>
                                    <th>Additional Fee ($)</th>
                                    <td><input type="text" name="currency[deposit_fees_additional]"
                                            class="inpts nosize" value="{{ $currency->deposit_fees_additional }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min ($)</th>
                                    <td><input type="text" name="currency[deposit_fees_min]" class="inpts nosize"
                                            value="{{ $currency->deposit_fees_min }}">
                                    </td>
                                    <th>Max ($)</th>
                                    <td><input type="text" name="currency[deposit_fees_max]" class="inpts nosize"
                                            value="{{ $currency->deposit_fees_max }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table> <br><br> <br>
                        <h3>Withdraw:</h3>
                        <table class="form nosize">
                            <tbody>
                                <tr>
                                    <th class="title" colspan="4">Withdraw Limits:</th>
                                </tr>
                                <tr>
                                    <th>Min ($)</th>
                                    <td><input type="text" name="currency[withdrawal_min]" class="inpts nosize"
                                            value="{{ $currency->withdrawal_min }}">
                                    </td>
                                    <th>Max ($)</th>
                                    <td><input type="text" name="currency[withdrawal_max]" class="inpts nosize"
                                            value="{{ $currency->withdrawal_max }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="title" colspan="4">Withdraw Fees:</th>
                                </tr>
                                <tr>
                                    <th>Fee (%)</th>
                                    <td><input type="text" name="currency[withdrawal_fees_percentage]"
                                            class="inpts nosize" value="{{ $currency->withdrawal_fees_percentage }}">
                                    </td>
                                    <th>Additional Fee ($)</th>
                                    <td><input type="text" name="currency[withdrawal_fees_additional]"
                                            class="inpts nosize" value="{{ $currency->withdrawal_fees_additional }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Min ($)</th>
                                    <td><input type="text" name="currency[withdrawal_fees_min]"
                                            class="inpts nosize" value="{{ $currency->withdrawal_fees_min }}">
                                    </td>
                                    <th>Max ($)</th>
                                    <td><input type="text" name="currency[withdrawal_fees_max]"
                                            class="inpts nosize" value="{{ $currency->withdrawal_fees_max }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table> <br>
                        @if ($withdrawal)
                            <h3>Auto-Withdraw:</h3>
                            <table class="form psettings" style="display:table" id="withdraw_settings_48">
                                <tbody>
                                    <tr>
                                        <th>Auto-Withdraw Status:</th>
                                        <td> <select name="currency[auto_withdrawal]" class="inpts">
                                                <option {{ !$currency->auto_withdrawal ? 'selected' : '' }}
                                                    value="0">Off</option>
                                                <option {{ $currency->auto_withdrawal ? 'selected' : '' }}
                                                    value="1">On</option>
                                            </select> </td>
                                    </tr>
                                    <tr>
                                        <th>Processing:</th>
                                        <td><select name="currency[withdrawal_processor]" class="inpts"
                                                onchange="withdraw_open_payment_settings()" id="withdraw_select">
                                                <option value="">None</option>
                                                @foreach ($withdrawal as $with)
                                                    <option
                                                        {{ $currency->withdrawal_processor == $with['meta_data']->code ? 'selected' : '' }}
                                                        value="{{ $with['meta_data']->code }}">
                                                        {{ $with['meta_data']->displayName }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @foreach ($withdrawal as $with)
                                                <table class="form withdraw_settings psettings"
                                                    id="withdraw_settings_{{ $with['meta_data']->code }}"
                                                    style="display: none;">
                                                    <tbody>
                                                        @foreach ($with['withdrawal_fields'] as $field)
                                                            <tr>
                                                                <th>{{ $field['display_name'] }}:</th>
                                                                <td>
                                                                    @if ($field['type'] == 'text')
                                                                        <input type="text"
                                                                            name="settings[{{ $field['field_name'] }}]"
                                                                            value="{{ $field['value'] }}"
                                                                            title="{{ $field['display_name'] }}"
                                                                            class="inpts" size="30">
                                                                    @endif
                                                                    @if ($field['type'] == 'checkbox')
                                                                        <input type="checkbox"
                                                                            name="settings[{{ $field['field_name'] }}]"
                                                                            value="{{ $field['value'] }}"
                                                                            title="{{ $field['display_name'] }}"
                                                                            class="inpts">
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="alert alert-warning">
                                                                    {!! $with['withdrawal_instructions'] !!}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endforeach
                                            <script>
                                                function withdraw_open_payment_settings() {
                                                    var sel = document.getElementById("withdraw_select");
                                                    var proc = sel.options[sel.selectedIndex].value;

                                                    document.querySelectorAll(".withdraw_settings").forEach(element => {
                                                        element.style.display = "none";
                                                    });

                                                    if (proc) {
                                                        document.getElementById("withdraw_settings_" + proc).style.display = "table";
                                                    }
                                                }
                                                withdraw_open_payment_settings();
                                            </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="alert alert-warning"> Select a processing for
                                                {{ $currency->display_name }} withdrawals
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="form nosize">
                                <tbody>
                                    <tr>
                                        <th class="title" colspan="4">Auto-Withdraw Limits:</th>
                                    </tr>
                                    <tr>
                                        <th>Min ($)</th>
                                        <td><input type="text" name="currency[auto_withdrawal_min]"
                                                class="inpts nosize" value="{{ $currency->auto_withdrawal_min }}">
                                        </td>
                                        <th>Max ($)</th>
                                        <td><input type="text" name="currency[auto_withdrawal_max]"
                                                class="inpts nosize" value="{{ $currency->auto_withdrawal_max }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        <br><br>
                        <center> <input type="submit" value="Update" class="btn btn-success sbmt"> <a
                                type="button" href="{{ route('admin.processings') }}" class="btn btn-warning sbmt">
                                Return</a></center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    </x-tempe.admin>
