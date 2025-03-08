<?php

namespace App\Http\Controllers\User;

use App\Events\WithdrawalRequestEvent;
use App\Handlers\PaymentHandler;
use App\Http\Controllers\Controller;
use App\Interfaces\CreateWithdrawalInput;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Traits\WithdrawalsTrait;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class WithdrawalsController extends Controller
{
    use WithdrawalsTrait;

    public function index(Request $request)
    {
        $withdrawals = Withdrawal::query()
            ->where('user_id', $request->user()->id)
            ->where(function ($handler) {

                if (request('status', ''))
                    $handler->where('status', request('status'));

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


        $min_withdrawal = Setting::get('min_withdrawal');

        // calculate chages 
        $wallets = Wallet::whereBelongsTo($request->user())->get()->all();


        foreach ($wallets as &$wallet) {
            $currency = Currency::find($wallet->currency_id);
            $wallet->withdrawable =
                $wallet->balance -
                $this->getWithdrawalCharges(
                    $currency,
                    (float) $wallet->balance
                );

            $wallet->max_withdrawal = $currency->withdrawal_max;
            $wallet->min_withdrawal = $currency->withdrawal_min;
        }

        return view('pages.user.withdrawals', [
            'withdrawals' => $withdrawals,
            'min_withdrawal' => $min_withdrawal,
            'wallets' => $wallets
        ]);
    }

    public function view(Request $request, $id)
    {
        $withdrawal = Withdrawal::whereBelongsTo($request->user())
            ->findOrFail($id);

        $transactions = Transaction::whereBelongsTo($request->user())
            ->where('log_type', 'withdrawal')
            ->where('transaction_id', $id)->get()->all();

        return view('pages.user.view-withdrawal', [
            'withdrawal' => $withdrawal,
            'transactions' => $transactions
        ]);
    }

    public function destroy(Request $request, $id)
    {
        Withdrawal::whereBelongsTo($request->user())
            ->where('status', 'pending')
            ->where('id', $id)
            ->delete();

        return back()->with('success', "Withdrawal deleted successfully");
    }

    public function create(Request $request, PaymentHandler $paymentHandler)
    {
        $user = $request->user();

        $request->validate([
            'amount' => 'required|numeric',
            'wallet_id' => 'required|numeric'
        ]);

        $wallet = Wallet::whereBelongsTo($user)->findOrFail($request->wallet_id);
        $currency = Currency::findOrFail($wallet->currency_id);

        // check if wallet balance is enough
        if ($wallet->balance < $request->amount) {
            return back()->with("error", "Insufficient funds. Wallet Balance: \$" . number_format($wallet->balance, 2));
        }

        // check if amount is lower than minimum
        if (empty($currency->withrawal_min) && $request->amount < Setting::get('min_withdrawal')) {
            return back()->with("error", "Withdrawal amount of $" . $request->amount . " is lower than minimum withdrawal of $" . Setting::get('min_withdrawal'));
        } else if ($request->amount < $currency->withdrawal_min) {
            return back()->with("error", "Withdrawal amount of $" . $request->amount . " is lower than minimum withdrawal of $" . $currency->withdrawal_min);
        }

        // check if user has currency max withdrawal
        if (!empty($currency->withdrawal_max) && $request->amount > $currency->withdrawal_max) {
            return back()->with("error", "Withdrawal amount of $" . $request->amount . " is higher than maximum withdrawal of $" . $currency->withdrawal_max);
        }

        //check max withdrawable
        $withdrawable = $wallet->balance - $this->getWithdrawalCharges($currency, (float) $wallet->balance);
        if ($request->amount > $withdrawable) {
            return back()->with("error", "You can only withdraw a maximum of $" . $withdrawable . " because of charges.");
        }

        $transactionID = Uuid::generate()->string;

        // create withdrawal request
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'amount' => $request->amount,
            'transaction_id' => $transactionID,
            'charges' => $this->getWithdrawalCharges($currency, $request->amount),
            'crypto_currency' => $wallet->currency_code,
            'address' => $wallet->deposit_address,
        ]);

        // process automatically
        if (
            $currency->withdrawal_processor
            && $wallet->deposit_address
            && $user->auto_withdrawal
            && $currency->auto_withdrawal
            && $request->amount >= $currency->auto_withdrawal_min
            && (empty($currency->auto_withdrawal_max)
                || $request->amount <= $currency->auto_withdrawal_max
            )
            && Setting::get('site_auto_withdrawal')
            && (empty(Setting::get('site_auto_withdrawal_max'))
                || $request->amount <= Setting::get('site_auto_withdrawal_max')
            )
        ) {
            /**
             * @var \App\Interfaces\PaymentHandlerInterface
             */
            $paymentProvider = $paymentHandler->getProvider($currency->withdrawal_processor);

            if ($paymentProvider->canWithdraw($currency->code)) {
                $charge = $paymentProvider->createWithdrawal(new CreateWithdrawalInput(
                    $wallet->deposit_address,
                    $request->amount,
                    $currency->code,
                    "Withdrawal Request of {$request->amount}",
                    $transactionID,
                    $user->email,
                    $paymentProvider->getWithdrawalIpn()
                ));

                // continue if there was no error
                if ($charge->success) {
                    $withdrawal->update([
                        'crypto_amount' => $charge->cryptoAmount,
                        'status_link' => $charge->transactionLink,
                        'details' => json_encode($charge),
                    ]);

                    // mark approval
                    $approve = $this->approveWithdrawal($withdrawal->id);

                    if ($approve['success']) {
                        $url = route('user.withdrawals.view', $withdrawal->id);
                        return redirect()->to($url)->with("success", "Withdrawal processed successfully. Withdrawal will appear in your wallet shortly.");
                    }
                }
                // put some log for admin
            }
        }

        // dispatch event if it wont be processed automatically
        if ($withdrawal) {
            WithdrawalRequestEvent::dispatch($withdrawal, $user);
            $url = route('user.withdrawals.view', $withdrawal->id);
            return redirect()->to($url)->with('success', "The withdrawal request has been received.");
        } else {
            return back()->with("error", 'Unable to process request at the moment. Please try again later');
        }
    }
}
