<?php

namespace App\Support;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Traits\DepositsTrait;
use Illuminate\Support\Facades\Log;

class CalculateInterest
{
    use DepositsTrait;

    public function __construct()
    {
    }

    public function calculate()
    {
        // release all deposits that the final interest date has passed
        // fetch all pending deposits
        $deposits = Deposit::where('status', 'approved')->get()->all();

        if (empty($deposits)) {
            Log::channel('interest')->info("No deposits to process");
            return 0;
        }

        $now = time();

        // loop through each
        foreach ($deposits as $deposit) {

            // find user first
            $user = $deposit->user()->first();

            if (empty($user->id)) {
                // deposit without a user detected. Delete asap
                $deposit->delete();
                Log::channel('interest')->info("User {$deposit->username} ({$deposit->user_id}) seems to have disappeared, leaving Deposit {$deposit->id} as an orphan. Let the orphan go home!");
                continue;
            }

            if (empty($user->status)) {
                // user inactive
                Log::channel('interest')->info("User {$user->username} inactive!");
                continue;
            }

            // set a reference date for calculations
            // use the deposit approval date if the last interest date is still null.
            $referenceDate = !empty($deposit->last_interest_date) ? $deposit->last_interest_date : $deposit->approval_date;

            // check the interest plan, see whether the current time is good to pay interest
            switch ($deposit->profit_frequency) {
                case 'year': {
                        $minimumInterval = 52 * 7 * 24 * 60 * 60; // wk*dy*hr*min*secs
                        break;
                    }
                case 'month': {
                        $minimumInterval = 4 * 7 * 24 * 60 * 60; // wk*dy*hr*min*secs
                        break;
                    }
                case 'week': {
                        $minimumInterval = 7 * 24 * 60 * 60; // dy*hr*min*secs
                        break;
                    }
                case 'day': {
                        $minimumInterval = 24 * 60 * 60; //hr*min*secs
                        break;
                    }
                case 'hour': {
                        $minimumInterval = 60 * 60; //min*secs
                        break;
                    }
                case 'minute': {
                        $minimumInterval = 60; // secs
                        break;
                    }
                case 'end': {
                        // should be end of plan
                        $minimumInterval = strtotime($deposit->final_interest_date) - strtotime($referenceDate) - 60; // give 1 minute grace
                        break;
                    }
                default: {
                        Log::channel('interest')->error("Unable to detect profit_frequency for {$deposit->id}");
                        break;
                    }
            }

            if (empty($minimumInterval)) continue;

            // be sure there is a date to work with
            if (empty($referenceDate)) {
                Log::channel('interest')->error("{$deposit->id} has issue with deposit_approval_date and last_interest_date.");
                continue;
            }

            // check time difference between now and when interest was last paid
            $timeDiff = $now - strtotime($referenceDate);

            // check if deposit is qualified to receive interest right now
            if ($timeDiff < $minimumInterval) continue;

            // it is good to pay
            try {
                // calculate interest and add pay
                $interest = round($deposit->percentage / 100 * $deposit->amount, 2);
                $wallet = Wallet::whereBelongsTo($user)->where('currency_code', $deposit->crypto_currency)->first();
                $wallet->increment('balance', $interest);

                // update the deposit last paid interest
                $deposit->update(['last_interest_date', now()]);
                $deposit->increment('interest_balance',  $interest);

                // add the record to logs too
                Transaction::create([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'log_type' => 'deposit-earning',
                    'crypto_currency' => $deposit->crypto_currency,
                    'transaction_details' => "Earning from deposit of $" . $deposit->amount . " - " . $deposit->percentage . "%",
                    'transaction_id' => $deposit->id,
                    'amount' => $interest
                ]);

                // log success
                Log::info("Deposit {$deposit->id}: timeDiff = {$timeDiff}, minimumInterval = {$minimumInterval}");

                Log::channel('interest')->info("Earning of \${$interest} ({$deposit->crypto_currency}) added to {$user->username}.");
            } catch (\Exception $e) {
                Log::channel('interest')->error("{$e->getMessage()}, in file: {$e->getFile()}, line {$e->getLine()}");
                continue;
            }

            // then check up on releases
            // verify that its end of plan or interest date not passed
            if (($deposit->profit_frequency === "end") || empty($deposit->final_interest_date) || strtotime($deposit->final_interest_date) < $now) {
                // release deposits that have passed
                $this->releaseDeposit($deposit->id);
                continue;
            }

            return 0;
        }
    }
}
