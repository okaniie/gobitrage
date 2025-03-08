<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // users
        $users['active'] = User::where('user_type', 'user')->where('status', '1')->get()->count() ?? 0;
        $users['blocked'] = User::where('user_type', 'user')->where('status', '0')->get()->count() ?? 0;
        $users['total'] = $users['active'] + $users['blocked'];

        // deposits
        $deposits = Deposit::select('crypto_currency as currency', 'status')
            ->selectRaw('COUNT(*) as total, SUM(amount) as amount')
            ->groupBy(['currency', 'status'])
            ->orderBy('currency')->get()->all();

        // withdrawals
        $withdrawals = Withdrawal::select(['crypto_currency as currency', 'status'])
            ->selectRaw('COUNT(*) as total, SUM(amount) as amount')
            ->groupBy(['currency', 'status'])
            ->orderBy('currency')->get()->all();

        // plans
        $plans = Plan::count() ?? 0;

        // referrals
        $referrals = [
            'total' => Referral::count() ?? 0,
            'amount' => Referral::sum('referral_bonus') ?? 0,
        ];

        // transactions
        $transactions = Transaction::select(['log_type as type', 'crypto_currency as currency'])
            ->selectRaw('COUNT(*) as total, SUM(amount) as amount')
            ->groupBy(['type', 'currency'])
            ->orderBy('currency')->get()->all();

        return view('pages.admin.dashboard', [
            'users' => $users,
            'deposits' => $deposits,
            'withdrawals' => $withdrawals,
            'plans' => $plans,
            'transactions' => $transactions,
            'referrals' => $referrals,
        ]);
    }
}
