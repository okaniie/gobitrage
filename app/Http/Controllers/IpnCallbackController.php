<?php

namespace App\Http\Controllers;

use App\Handlers\PaymentHandler;
use App\Interfaces\PaymentHandlerInterface;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\Withdrawal;
use App\Traits\DepositsTrait;
use App\Traits\WithdrawalsTrait;
use Illuminate\Http\Request;

class IpnCallbackController extends Controller
{
    use DepositsTrait;
    use WithdrawalsTrait;

    public function deposit(Request $request, PaymentHandler $paymentHandler, $processor)
    {
        $paymentProcessor = $paymentHandler->getProvider($processor);

        if (!$paymentProcessor instanceof PaymentHandlerInterface) return;

        $processed = $paymentProcessor->handleDepositIpnCallback($request);

        if ($processed->success) {
            // check if transaction is valid
            // fetch deposit
            $deposit = Deposit::where('transaction_id', $processed->transactionId)->get()->first();
            if (!$deposit) {
                echo "deposit not found";
                return;
            }

            if ($deposit->status !== "pending") {
                echo "Deposit processed previously";
                return;
            }

            $plan = Plan::find($deposit->plan_id);
            if (!$plan) {
                echo "Deposit plan not found";
                return;
            }

            $user = $deposit->user()->first();
            if (!$user) {
                echo "user not found";
                return;
            }

            // check if price is correct
            $total_amount = $deposit->amount + $deposit->charges;

            if (abs($total_amount - $processed->amount) > 5) {
                echo "invalid deposit amount detected.";
                return;
            }

            $deposit->update(['processor_details' => json_encode($processed)]);

            $this->approveDeposit($deposit->id);

            echo $processed->message;

            return;
        }

        return;
    }

    public function withdrawal(Request $request, PaymentHandler $paymentHandler, $processor)
    {
        $paymentProcessor = $paymentHandler->getProvider($processor);

        if (!$paymentProcessor instanceof PaymentHandlerInterface) return;

        $processed = $paymentProcessor->handleWithdrawalIpnCallback($request);

        if ($processed->success) {
            // add stuff for user
            $withdrawal = Withdrawal::where('transaction_id', $processed->transactionId)->first();
            if (!$withdrawal) {
                echo "withdrawal not found";
                return;
            }

            if ($withdrawal->status !== "pending") {
                echo "Withdrawal processed previously";
                return;
            }

            $user = $withdrawal->user()->first();
            if (!$user) {
                echo "user not found";
                return;
            }

            // dispatch the operation
            $this->approveWithdrawal($withdrawal->id);
        }

        return;
    }
}
