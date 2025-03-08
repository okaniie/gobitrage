<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index(Request $request)
    {
        $referrals = Referral::query()
            ->where('referral_user_id', $request->user()->id)
            ->where(function ($handler) {

                if (request('query', ''))
                    $handler->where('referred_username', request('query'))
                        ->orWhere('referral_username', request('query'));

                if (request()->get('to', '') || request('from', '')) {
                    $handler->whereBetween(
                        'created_at',
                        [
                            request('from', now("-7days")),
                            request('to', now())
                        ]
                    );
                }
            })
            ->cursorPaginate(request('rpp', 20))
            ->appends('rpp', request('rpp', ''))
            ->appends('from', request('from', ''))
            ->appends('to', request('to', ''));

        $totals = Referral::whereBelongsTo($request->user())
            ->selectRaw('COUNT(*) as total_referrals, SUM(referral_bonus) as total_referral_commission')
            ->select('referral_user_id')
            ->groupBy('referral_user_id')
            ->orderBy('referral_user_id')->get()->first();

        $total_referrals = $total_referral_commission = 0;
        if ($totals) {
            $total_referrals = $totals->total_referrals;
            $total_referral_commission = $totals->total_referral_commission;
        }

        return view('pages.user.referrals', [
            'referrals' => $referrals,
            'referral_link' => route('ref', $request->user()->id),
            'referral_overview' => [
                'total_referrals' => $total_referrals,
                'total_referral_commission' => $total_referral_commission
            ],
        ]);
    }

    public function view(Request $request, $id)
    {
        $referral = Referral::whereBelongsTo($request->user())
            ->findOrFail($id);

        $transactions = Transaction::whereBelongsTo($request->user())
            ->where('log_type', 'referral')
            ->where('transaction_id', $id)->get()->all();

        return view('pages.user.view-referral', [
            'referral' => $referral,
            'transactions' => $transactions
        ]);
    }
}
