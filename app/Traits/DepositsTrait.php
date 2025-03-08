<?php

namespace App\Traits;

use App\Events\DepositApproved;
use App\Events\DepositReleased;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Wallet;

trait DepositsTrait
{
    public function approveDeposit($id)
    {
        $deposit = Deposit::findOrFail($id);

        if ($deposit->status !== "pending") {
            return ['success' => false, 'message' => "You can only approve a pending deposit"];
        }

        $plan = Plan::findOrFail($deposit->plan_id);
        $user = $deposit->user()->first();

        $deposit->update([
            'status' => 'approved',
            'approval_date' => date("Y-m-d H:i:s", time()),
            'final_interest_date' => date(
                "Y-m-d H:i:s",
                strtotime("+{$plan->duration} {$plan->duration_type}s 1 minute")
            ),
        ]);

        // // add record to traillog
        Transaction::create([
            'user_id' => $deposit->user_id,
            'username' => $user->username,
            'log_type' => 'deposit',
            'transaction_details' => "Deposit for " . $plan->title . " Approved",
            'transaction_id' => $deposit->id,
            'amount' => $deposit->amount,
            'crypto_currency' => $deposit->crypto_currency
        ]);

        // verify if can pay referral commission and only if deposit is from processor
        if ($deposit->deposit_from == "processor" && Setting::get('pay_referral')) {
            Referral::payReferral($deposit->user_id, $deposit->amount, $plan->percentage, $deposit->crypto_currency);
        }

        // dispatch event
        DepositApproved::dispatch($deposit);

        return ['success' => true, 'message' => "Deposit approved successfully"];
    }

    public function getDepositCharges(Currency $currency, float $amount): float
    {
        $min = (float) $currency->deposit_fees_min;
        $max = (float) $currency->deposit_fees_max;
        $percent = (float) $currency->deposit_fees_percentage;
        $additional = (float) $currency->deposit_fees_additional;

        // if there's no percentage, then return only additional fees
        if (empty($percent)) return $additional;

        $charges = (float) ($percent * $amount / 100);

        if ($charges < $min) return $min + $additional;
        if ($charges > $max) return $max + $additional;

        return round($charges, 2) + $additional;
    }


    public function releaseDeposit($id)
    {

        $deposit = Deposit::findOrFail($id);

        if ($deposit->status !== "approved") {
            return ['success' => false, 'message' => "You can only release an active deposit"];
        }

        $user = $deposit->user()->first();
        // get wallet
        Wallet::whereBelongsTo($user)
            ->where('currency_code', $deposit->crypto_currency)
            ->first()
            ->increment('balance', $deposit->amount);

        // mark as released
        $deposit->update(['status' => 'released']);

        // add record to transaction
        Transaction::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'log_type' => 'deposit-release',
            'transaction_details' => "Deposit amount \${$deposit->amount} released",
            'transaction_id' => $deposit->id,
            'amount' => "-" . $deposit->amount,
            'crypto_currency' => $deposit->crypto_currency
        ]);

        // dispatch event
        DepositReleased::dispatch($deposit);

        return ['success' => true, 'message' => "Deposit released successfully."];
    }
}
