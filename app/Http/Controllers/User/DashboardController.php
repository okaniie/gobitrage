<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $total_balance = $total_bonus = $total_deposit =
            $total_withdrawal = $total_penalty =
            $total_referral = $total_earning =
            $last_withdrawal = $last_deposit = 0;

        $id = auth()->user()->id;

        // total_balance
        $total_balance = Wallet::whereBelongsTo(auth()->user())
            ->sum('balance');


        // deposits
        $d = Deposit::select(['status'])
            ->selectRaw('SUM(amount) as amount')
            ->where(['user_id' => $id, 'status' => 'approved'])
            ->groupBy('status')
            ->orderBy('status')
            ->get()->first();

        $active_deposit = $d ? (float) $d->amount : 0;

        $ld = Deposit::select('amount')
            ->where(['user_id' => $id, 'status' => 'approved'])
            ->get()->last();
        if ($ld) $last_deposit = $ld->amount;

        // withdrawals
        $w = Withdrawal::select(['status as status'])
            ->selectRaw('SUM(amount) as amount')
            ->where(['user_id' => $id, 'status' => 'pending'])
            ->groupBy('status')
            ->orderBy('status')
            ->get()->first();

        $pending_withdrawal = $w ? (float) $w->amount : 0;

        $lw = Withdrawal::select('amount')
            ->where(['user_id' => $id, 'status' => 'approved'])
            ->get()->last();
        if ($lw) $last_withdrawal = $lw->amount;

        // referrals
        $r = Referral::select(['referral_user_id'])
            ->selectRaw('COUNT(*) as total, SUM(referral_bonus) as amount')
            ->where(['referral_user_id' => $id])
            ->groupBy('referral_user_id')
            ->orderBy('referral_user_id')
            ->get()->first();

        $referral = $r ? (float) $r->total : 0;
        $referral_commission = $r ? (int) $r->amount : 0;

        // transactions
        $d = Transaction::select(['log_type as type'])
            ->selectRaw('SUM(amount) as amount')
            ->where(['user_id' => $id])
            ->groupBy('type')
            ->orderBy('type')
            ->get()->all();

        foreach ($d as $dd) {
            if ($dd->type == 'bonus') $total_bonus = (float) $dd->amount;
            if ($dd->type == 'deposit') $total_deposit = (float) $dd->amount;
            if ($dd->type == 'withdrawal') $total_withdrawal = (float) $dd->amount;
            if ($dd->type == 'penalty') $total_penalty = (float) $dd->amount;
            if ($dd->type == 'referral') $total_referral = (float) $dd->amount;
            if ($dd->type == 'deposit-earning') $total_earning = (float) $dd->amount;
        }

        return view(
            'pages.user.dashboard',
            [
                'total_balance' => $total_balance,
                'account_balance' => [],
                'active_deposit' => $active_deposit,
                'pending_withdrawal' => $pending_withdrawal,
                'referral' => $referral,
                'referral_commission' => $referral_commission,
                'total_bonus' => $total_bonus,
                'total_deposit' => $total_deposit,
                'total_withdrawal' => $total_withdrawal,
                'total_penalty' => $total_penalty,
                'total_referral' => $total_referral,
                'total_earning' => $total_earning,
                'last_withdrawal' => $last_withdrawal,
                'last_deposit' => $last_deposit,
            ]
        );
    }
}
