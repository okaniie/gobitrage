<?php

namespace App\Traits;

use App\Events\WithdrawalApproved;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;

trait WithdrawalsTrait
{
    public function approveWithdrawal($id)
    {

        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== "pending") {
            return ['success' => false, 'message' => "You can only approve pending withdrawal"];
        }

        $user = $withdrawal->user()->first();

        Wallet::whereBelongsTo($user)
            ->where('currency_code', $withdrawal->crypto_currency)->first()
            ->decrement('balance', $withdrawal->amount + $withdrawal->charges);

        $withdrawal->update(['status' => 'approved']);

        // add record to transaction
        Transaction::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'log_type' => 'withdrawal',
            'transaction_details' => "Withdrawal of \${$withdrawal->amount} Approved",
            'transaction_id' => $withdrawal->id,
            'amount' => $withdrawal->amount,
            'crypto_currency' => $withdrawal->crypto_currency
        ]);

        // dispatch
        WithdrawalApproved::dispatch($withdrawal);

        return ['success' => true, 'message' => "Withdrawal approved successfully"];
    }

    public function getWithdrawalCharges(Currency $currency, float $amount): float
    {
        $min = (float) $currency->withdrawal_fees_min;
        $max = (float) $currency->withdrawal_fees_max;
        $percent = (float) $currency->withdrawal_fees_percentage;
        $additional = (float) $currency->withdrawal_fees_additional;

        // if there's no percentage, then return only additional fees
        if (empty($percent)) return $additional;

        $charges = (float) ($percent * $amount / 100);

        if ($charges < $min) return $min + $additional;
        if ($charges > $max) return $max + $additional;

        return round($charges, 2) + $additional;
    }
}
