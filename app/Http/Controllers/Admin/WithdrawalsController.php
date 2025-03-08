<?php

namespace App\Http\Controllers\Admin;

use App\Events\WithdrawalApproved;
use App\Events\WithdrawalDeclined;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Traits\WithdrawalsTrait;
use Illuminate\Http\Request;

class WithdrawalsController extends Controller
{

    use WithdrawalsTrait;

    public function index()
    {

        $withdrawals = Withdrawal::query()
            ->where(function ($handler) {

                if (request('currency', ''))
                    $handler->where('crypto_currency', request('currency'));

                if (request('status', ''))
                    $handler->where('status', request('status'));

                if (request('user_id', ''))
                    $handler->where('user_id', request('user_id'));

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

        return view('pages.admin.withdrawals.index', [
            'withdrawals' => $withdrawals
        ]);
    }

    public function viewSingle($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $transactions = Transaction::where('log_type', 'withdrawal')
            ->where('transaction_id', $id)->get()->all();

        return view('pages.admin.withdrawals.view', [
            'withdrawal' => $withdrawal,
            'transactions' => $transactions
        ]);
    }

    public function delete($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->status !== "pending") {
            return back()->with('error', "You can only delete pending withdrawals.");
        }

        $withdrawal->delete();

        return back()->with('success', 'Record deleted successfully.');
    }

    public function decline($id)
    {

        $withdrawal = Withdrawal::findOrFail($id);

        $message = request('message', 'withdrawal declined');

        if ($withdrawal->status !== "pending") {
            return back()->with('error', "You can only decline pending withdrawal");
        }

        $withdrawal->update(['status' => 'declined', 'message_from_admin' => $message]);

        // dispatch
        WithdrawalDeclined::dispatch($withdrawal);

        return back()->with('success', "Withdrawal declined successfully");
    }

    public function approve($id)
    {
        $approve = $this->approveWithdrawal($id);
        if (!$approve['success']) {
            return back()->with("error", $approve['message']);
        }
        return back()->with('success', "Withdrawal approved successfully");
    }
}
