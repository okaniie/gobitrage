<x-template.admin title="Dashboard" slug="dashboard">
    <h3>Information</h3>
    <table class="form">
        <tbody>
            <tr>
                <th>Users:</th>
                <td>
                    <a data-hlp="Total users registered in the system"
                        class="hlp badge badge-info"><?= $users['active'] ?></a>
                    <a data-hlp="How many active users does your system contain"
                        class="hlp badge badge-success"><?= $users['active'] ?>
                        <?php if ($users['total'] !== 0) : ?>
                        (<?php echo number_format(($users['active'] / $users['total']) * 100, 2); ?>%)
                        <?php endif; ?>
                    </a>
                    <a data-hlp="How many users are disabled (cannot login and can not earn any funds from principal)"
                        class="hlp badge badge-danger">
                        <?= $users['blocked'] ?>
                        <?php if ($users['total'] !== 0) : ?>
                        (<?php echo number_format(($users['blocked'] / $users['total']) * 100, 2); ?>%)
                        <?php endif; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Investment Packages:</th>
                <td> <a data-hlp="Active investment packages number. Active users earn if they have deposited funds in these packages."
                        class="hlp badge badge-success"><?= $plans ?></a> </td>
            </tr>
            <tr>
                <th>Withdrawals</th>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <th>Currency</th>
                                <th style="text-align: left;">Status</th>
                                <th style="text-align: left;">Total</th>
                                <th style="text-align: left;">Amount</th>
                            </tr>
                            <?php foreach ($withdrawals as $key => $item) : ?>
                            <tr class="<?= $key % 2 ? 'row2' : 'row1' ?>">
                                <th><img alt="{{ $item->currency }}" /></th>
                                <td>
                                    <a class="link strong"
                                        href="{{ route('admin.withdrawals', ['status' => $item->status, 'crypto_currency' => $item->currency]) }}">
                                        {{ $item->status }}
                                    </a>
                                </td>
                                <td class="strong">{{ $item->total }}</td>
                                <td class="strong text-right text-{{ $item->status }}">
                                    ${{ number_format($item->amount, 2) }}</td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th>Deposits</th>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <th>Currency</th>
                                <th style="text-align: left;">Status</th>
                                <th style="text-align: left;">Total</th>
                                <th style="text-align: left;">Amount</th>
                            </tr>
                            <?php foreach ($deposits as $key => $item) : ?>
                            <tr class="<?= $key % 2 ? 'row2' : 'row1' ?>">
                                <th><img alt="{{ $item->currency }}" /></th>
                                <td>
                                    <a class="link strong"
                                        href="{{ route('admin.deposits', ['status' => $item->status, 'crypto_currency' => $item->currency]) }}">
                                        {{ ucwords($item->status) }}
                                    </a>
                                </td>
                                <td class="strong">{{ $item->total }}</td>
                                <td class="strong text-right text-{{ $item->status }}">
                                    ${{ number_format($item->amount, 2) }}</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th>Transactions</th>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <th>Currency</th>
                                <th style="text-align: left;">Type</th>
                                <th style="text-align: left;">Total</th>
                                <th style="text-align: left;">Amount</th>
                            </tr>
                            <?php foreach ($transactions as $key => $item) : ?>
                            <tr class="<?= $key % 2 ? 'row2' : 'row1' ?>">
                                <th><img alt="<?= $item->currency ?>" /></th>
                                <td>
                                    <a class="link strong text-<?= $item->type ?>"
                                        href="{{ route('admin.transactions', ['log_type' => $item->type, 'crypto_currency' => $item->currency]) }}">
                                        {{ ucwords($item->type) }}
                                    </a>
                                </td>
                                <td class="strong">{{ $item->total }}</td>
                                <td class="strong text-right text-{{ $item->type }}">
                                    ${{ number_format($item->amount, 2) }}</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="alert alert-warning">
        Welcome to the Crypto-HYIP Pro Admin Area!<br>
        You can see help messages on almost all pages of the admin area in this part.<br> <br>
        You can see how many members are registered in the system on this page.<br>
        System supports 2 types of users:<br>
        <li>Active users. These users can login to the members area and receive earnings.</li>
        <li>Disabled users. These users can not login to the members area and will not receive any earnings.</li> <br>
        User becomes active when registering and only administrator can change status of any registered user. You can
        see
        how many users are active and disabled in the system at the top of this page. <br> <br>
        Investment packages:<br> You can create unlimited sets of investment packages with any settings and payout
        options<br><br>
    </div>

</x-template.admin>
