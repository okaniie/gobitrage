<x-template.admin title="Users" slug="users">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Users: <a class="sbmt btn btn-success" href="{{ route('admin.users.new') }}">Add
                            User</a>
                    </h3>
                    <form method="get">
                        @foreach ($_GET as $key => $value)
                            @if (in_array($key, ['query', 'from', 'to', 'rpp']))
                                <input name='{{ $key }}' value='{{ $value }}' hidden />
                            @endif
                        @endforeach
                        <table class="form controls nosize">
                            <tbody>
                                <tr>
                                    <td>Search:</td>
                                    <td>
                                        <input type="text" name="query"
                                            value="{{ request()->has('query') ? request()->get('query') : '' }}"
                                            class="inpts nosize" size="30">
                                    </td>
                                    <td> Per Page: <select name="rpp" class="inpts nosize">
                                            @if (request()->has('rpp'))
                                                <option {{ request()->get('rpp') == '20' ? 'selected' : '' }}>20
                                                </option>
                                                <option {{ request()->get('rpp') == '50' ? 'selected' : '' }}>50
                                                </option>
                                                <option {{ request()->get('rpp') == '100' ? 'selected' : '' }}>100
                                                </option>
                                            @else
                                                <option>20</option>
                                                <option>50</option>
                                                <option>100</option>
                                            @endif
                                        </select> </td>
                                    <td style="text-align:right"> <input type="submit" value="Apply" class="sbmt">
                                    </td>
                                </tr>
                            </tbody>
                        </table> <br>
                    </form>
                    <table class="list">
                        <tbody>
                            <tr>
                                <th>User</th>
                                <th>Balances</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($users as $key => $user)
                                <tr class="{{ $key % 2 == 0 ? 'row1' : 'row2' }}">
                                    <td valign="top">
                                        <table class="list sub" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <b class="username">
                                                            <a href="{{ route('admin.users.funds', ['id' => $user->id]) }}"
                                                                class="link"
                                                                style="margin-bottom:2px;">{{ $user->username }}</a>
                                                        </b>
                                                        <span class="badge badge-success">Active</span> <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Name: <i>{{ $user->name }}</i></td>
                                                </tr>
                                                <tr>
                                                    <td>Since: {{ $user->created_at }}</td>
                                                </tr>
                                                @if ($user->upliner)
                                                    <tr>
                                                        <td style="color:blue">Upline:
                                                            <i>{{ $user->upliner['username'] }}</i>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="list sub" width="100%">
                                            <tbody>
                                                @if ($user->wallets)
                                                    @foreach ($user->wallets as $wallet)
                                                        <tr>
                                                            <td style="width:50%">{{ $wallet['currency_code'] }}:</td>
                                                            <td>
                                                                <b style="color:gray">${{ $wallet->balance }}</b>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.view', ['id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-success" style="margin-bottom:2px;">edit</a><br>
                                        <a href="{{ route('admin.users.funds', ['id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info" style="margin-bottom:2px;">funds</a><br>
                                        <a href="{{ route('admin.users.delete', ['id' => $user->id]) }}"
                                            onclick="return confirm('Delete this user? This action cannot be undone.');"
                                            class="sbmt btn-sm btn-danger" style="margin-bottom:2px;">delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    <div style="margin-bottom: 2rem">
                        {{ $users->links() }}
                    </div>


                    <a class="sbmt btn btn-success" href="{{ route('admin.users.new') }}">Add
                        User</a>
                    <br> <br>
                    <div class="alert alert-warning">
                        Members list:<br><br> Members list splits your members to 2 types: Active and Disabled.<br>
                        Active: User can login and receive earnings if deposited in the system.<br>
                        Disabled: User can not login and cannot receive any earnings.<br> <br>

                        The top left search form
                        helps you to search a user by the nickname or e-mail. You can also enter a part of a nickname or
                        e-mail to search users.<br><br>
                        Edit user information: click on the "Edit" button next to a user<br>
                        Delete user: click on the "delete" button and confirm this action;<br>
                        Send e-mail to user: click on the "e-mail" button and send e-mail to user.<br>
                        "Manage funds": button will help you to check any user's history and change his funds.<br>
                        Add a new Member: click on the "Add a new member&amp; button.
                        You&amp;ll see the form for adding a new member. </div>
                </td>
            </tr>
        </tbody>
    </table>

</x-template.admin>
