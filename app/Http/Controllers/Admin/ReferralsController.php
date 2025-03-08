<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index()
    {

        $referrals = Referral::query()
            ->where(function ($handler) {

                if (request('crypto_currency', ''))
                    $handler->where('crypto_currency', request('crypto_currency'));

                if (request('user_id', ''))
                    $handler->where('referral_user_id', request('user_id'));

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
            ->where(function ($handler) {
                if (request()->get('query', '')) {
                    $q  = request()->get('query');
                    $handler->where('referred_username', 'LIKE', "%{$q}%");
                    $handler->orWhere('referral_username', 'LIKE', "%{$q}%");
                }
            })
            ->cursorPaginate(request('rpp', 20))
            ->appends('rpp', request('rpp', ''))
            ->appends('from', request('from', ''))
            ->appends('to', request('to', ''));

        return view('pages.admin.referrals.index', [
            'referrals' => $referrals
        ]);
    }
    public function viewSingle($id)
    {
        // find the referral
        $referral = Referral::findOrFail($id);

        // trailLog of referral
        $transactions = Transaction::where('log_type', 'referral')
            ->where('transaction_id', $id)->all();

        return view('pages.admin.referrals.view', [
            'referral' => $referral,
            'transactions' => $transactions
        ]);
    }
}
