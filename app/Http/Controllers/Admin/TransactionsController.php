<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::query()
            ->where(function ($handler) {

                if (request('currency', ''))
                    $handler->where('currency', request('currency'));

                if (request('log_type', ''))
                    $handler->where('log_type', request('log_type'));

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
            ->appends('log_type', request('log_type', ''))
            ->appends('rpp', request('rpp', ''))
            ->appends('from', request('from', ''))
            ->appends('to', request('to', ''));

        return view('pages.admin.transactions', [
            'transactions' => $transactions
        ]);
    }

    public function viewSingle(){
        
    }
    
}
