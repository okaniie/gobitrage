<?php

namespace App\Support;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Traits\DepositsTrait;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CalculateInterest
{
    use DepositsTrait;

    public function calculate()
    {
        $now = Carbon::now();
        $timestampNow = $now->timestamp;
        $intervalMinutes = 5; // payout every 5 minutes
        $intervalSeconds = $intervalMinutes * 60;

        // Process all approved deposits
        $deposits = Deposit::where('status', 'approved')->get();

        foreach ($deposits as $deposit) {
            // Validate user
            $user = $deposit->user()->first();
            if (!$user || !$user->status) {
                if (!$user) $deposit->delete();
                Log::channel('interest')->info(
                    !$user
                    ? "Deleted orphan deposit {$deposit->id}."
                    : "Skipped inactive user {$deposit->username}."
                );
                continue;
            }

            // Reference timestamp for last payout
            $reference = $deposit->last_interest_date
                ? Carbon::parse($deposit->last_interest_date)
                : Carbon::parse($deposit->approval_date);
            $referenceTs = $reference->timestamp;

            // Plan timing
            $planStartTs = Carbon::parse($deposit->approval_date)->timestamp;
            $planEndTs   = strtotime($deposit->final_interest_date);
            if ($timestampNow > $planEndTs) {
                // Plan ended; release deposit
                $this->releaseDeposit($deposit->id);
                continue;
            }

            // Linear rate distribution
            $targetRate = $deposit->percentage / 100; // e.g. 0.25 for 25%
            $totalDuration = $planEndTs - $planStartTs; // in seconds
            if ($totalDuration <= 0) continue;
            $ratePerSecond = $targetRate / $totalDuration;

            // Determine due payout blocks
            $elapsed = $timestampNow - $referenceTs;
            $blocks = floor($elapsed / $intervalSeconds);
            if ($blocks < 1) continue;

            // Interest = principal * ratePerSecond * (blocks * intervalSeconds)
            $principal = $deposit->amount;
            $interest = round($principal * $ratePerSecond * ($blocks * $intervalSeconds), 8);
            if ($interest <= 0) continue;

            // Apply interest
            try {
                $wallet = Wallet::whereBelongsTo($user)
                    ->where('currency_code', $deposit->crypto_currency)
                    ->first();
                $wallet->increment('balance', $interest);

                // Update deposit records
                $newLast = $reference->addSeconds($blocks * $intervalSeconds);
                $deposit->update([
                    'last_interest_date' => $newLast->toDateTimeString(),
                ]);
                $deposit->increment('interest_balance', $interest);

                // Log transaction
                Transaction::create([
                    'user_id'             => $user->id,
                    'username'            => $user->username,
                    'log_type'            => 'deposit-linear',
                    'crypto_currency'     => $deposit->crypto_currency,
                    'transaction_details' => "Linear interest payout for deposit {$deposit->id} ({$intervalMinutes}min block)",
                    'transaction_id'      => $deposit->id,
                    'amount'              => $interest,
                ]);

                Log::channel('interest')->info(
                    "Payout \${$interest} to {$user->username} for deposit {$deposit->id} after {$blocks} blocks."
                );
            } catch (\Exception $e) {
                Log::channel('interest')->error(
                    "Error paying linear interest for deposit {$deposit->id}: {$e->getMessage()}"
                );
                continue;
            }
        }

        Log::channel('interest')->info("Linear interest run completed at {$now->toDateTimeString()}");
    }
}
