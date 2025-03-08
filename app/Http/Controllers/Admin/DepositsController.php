<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Traits\DepositsTrait;

class DepositsController extends Controller
{
    use DepositsTrait;

    public function index()
    {

        $deposits = Deposit::query()
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

        return view('pages.admin.deposits.index', [
            'deposits' => $deposits
        ]);
    }

    public function viewSingle($id)
    {
        $deposit = Deposit::findOrFail($id);
        $transactions = Transaction::where('log_type', 'deposit')
            ->where('transaction_id', $id)->get()->all();

        return view('pages.admin.deposits.view', [
            'deposit' => $deposit,
            'transactions' => $transactions
        ]);
    }

    public function delete($id)
    {
        $deposit = Deposit::findOrFail($id);
        if ($deposit->status !== "pending") {
            return back()->with('error', "You can only delete pending deposits.");
        }

        $deposit->delete();

        return back()->with('success', 'Record deleted successfully.');
    }

    public function release($id)
    {

        $released = $this->releaseDeposit($id);

        if (!$released['success']) {
            return back()->with("error", $released['message']);
        }

        return back()->with('success', "Deposit released successfully.");
    }

    public function approve($id)
    {
        $approve = $this->approveDeposit($id);

        if (!$approve['success']) {
            return back()->with("error", $approve['message']);
        }

        return back()->with('success', "Deposit approved successfully");
    }
}
