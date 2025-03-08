<x-template.admin title="User Funds" slug="users">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <style>
                        .sbmt-group {
                            display: inline-block;
                            float: right;
                        }
                    </style>
                    <h3>User Details:</h3>
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Username:</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>E-mail:</th>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            </tr>
                            @if ($user->upline)
                                <tr>
                                    <th>Upline:</th>
                                    <td><a
                                            href="{{ route('admin.users.view', ['id' => $user->upline['id']]) }}">{{ $user->upline['username'] }}</a>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Referral Link:</th>
                                <td><input class="inpts" style="width: 100%;"
                                        value="{{ route('ref', ['ref' => $user->id]) }}" />
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <table class="list form">
                        <tbody>
                            <tr>
                                <th>Currency</th>
                                <th>Balance</th>
                                <th>Account</th>
                            </tr>
                            @if ($user->wallets)
                                @foreach ($wallets as $wallet)
                                    <tr>
                                        <th style="text-align:right">{{ $wallet->currency_code }}</th>
                                        <td>$ {{ $wallet->balance }}</td>
                                        <td>
                                            @if (!empty($wallet->deposit_address))
                                                {{ $wallet->deposit_address }}
                                            @else
                                                <a href="{{ route('admin.users.view', ['id' => $user->id]) }}">
                                                    <em>notset</em>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table> <br>
                    <table class="form">
                        <tbody>
                            <tr>
                                <th>Total Balance:</th>
                                <td>${{ $total_balance }}</td>
                            </tr>
                            <tr>
                                <th>Total Deposit:</th>
                                <td>${{ $total_deposit }} <div class="sbmt-group"><a
                                            href="{{ route('admin.transactions', ['log_type' => 'deposit', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info" style="float:right">history</a></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Active Deposit:</th>
                                <td>${{ $active_deposit }} <div class="sbmt-group"><a
                                            href="{{ route('admin.deposits', ['status' => 'approved', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-danger" style="float:right">manage deposits</a></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Earning:</th>
                                <td>${{ $total_earning }} <div class="sbmt-group"><a
                                            href="{{ route('admin.transactions', ['log_type' => 'deposit-earning', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info">history</a></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Withdrawal:</th>
                                <td>${{ $total_withdrawal }} <div class="sbmt-group"><a
                                            href="{{ route('admin.transactions', ['log_type' => 'withdrawal', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info">history</a></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Pending Withdrawals:</th>
                                <td>${{ $pending_withdrawal }} <div class="sbmt-group"><a
                                            href="{{ route('admin.withdrawals', ['status' => 'pending', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-danger">process withdrawals</a></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Bonus:</th>
                                <td>${{ $total_bonus }} <div class="sbmt-group"> <a
                                            href="{{ route('admin.users.bonus.add', ['id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-danger">add a bonus</a>
                                        <a href="{{ route('admin.transactions', ['log_type' => 'bonus', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info">history</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Penalty:</th>
                                <td>${{ $total_penalty }} <div class="sbmt-group"> <a
                                            href="{{ route('admin.users.penalty.add', ['id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-danger">add a penalty</a> <a
                                            href="{{ route('admin.transactions', ['log_type' => 'penalty', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info">history</a></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Referrals:</th>
                                <td>{{ $total_referral }} <div class="sbmt-group"> <a
                                            href="{{ route('admin.referrals', ['referral_user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-primary">referrals</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Referral Commissions:</th>
                                <td>${{ $referral_commission }} <div class="sbmt-group"><a
                                            href="{{ route('admin.transactions', ['log_type' => 'referral', 'user_id' => $user->id]) }}"
                                            class="sbmt btn-sm btn-info">history</a></div>
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>
                    <div class="alert alert-warning"> Manage user funds:<br> Account balance: how many funds can the
                        user
                        withdraw from the system.<br> Total deposit: how many funds has the user ever deposited to your
                        system.<br> Total active deposit: the whole current deposit of this user.<br> Total earnings:
                        how
                        many funds has the user ever earned with your system.<br> Total withdrawals: how many funds has
                        the
                        user ever withdrawn from system.<br> Total bonus: how many funds has the administrator ever
                        added to
                        the user account as a bonus.<br> Total penalty: how many funds has the administrator ever
                        deleted
                        from the user account as a penalty.<br> Actions:<br> Transactions history - you can check the
                        transactions history for this user.<br> Active deposits/Transactions history - you can check the
                        deposits history for this user.<br> Earnings history - you can check the earnings history for
                        this
                        user.<br> Withdrawals history - you can check the withdrawals history for this user.<br> Process
                        withdrawals - you can withdraw funds by clicking this link if a user asked you for a
                        withdrawal.<br>
                        Bonuses history - you can check the bonuses history for this user.<br>
                        Penalties history - you can check the penalties history for this user.<br> Add a bonus and add a
                        penalty - add a bonus or a penalty to this user.<br> </div>
                </td>
            </tr>
        </tbody>
    </table>


</x-template.admin>
