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

    private const FREQUENCY_SECONDS = [
        'minute' => 60,
        'hour' => 3600,
        'day' => 86400,
        'week' => 604800,
        'month' => 2592000,
        'year' => 31536000,
    ];

    public function calculate()
    {
        $now = Carbon::now();

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
            $planStart = Carbon::parse($deposit->approval_date);
            $planEnd = Carbon::parse($deposit->final_interest_date);
            $planStartTs = $planStart->timestamp;
            $planEndTs = $planEnd->timestamp;

            // Linear rate distribution
            $targetRate = $deposit->percentage / 100; // e.g. 0.25 for 25%
            $totalDuration = $planEndTs - $planStartTs; // in seconds
            if ($totalDuration <= 0) continue;
            $ratePerSecond = $targetRate / $totalDuration;

            $profitFrequency = $deposit->profit_frequency ?: 'end';
            $payoutUntil = null;
            $blocks = 0;

            if ($now->greaterThanOrEqualTo($planEnd)) {
                $payoutUntil = $planEnd;
            } elseif ($profitFrequency !== 'end') {
                $intervalSeconds = self::FREQUENCY_SECONDS[$profitFrequency] ?? null;
                if (!$intervalSeconds) {
                    Log::channel('interest')->warning(
                        "Skipped deposit {$deposit->id}: unsupported frequency '{$profitFrequency}'."
                    );
                    continue;
                }

                $elapsed = $now->timestamp - $referenceTs;
                $blocks = floor($elapsed / $intervalSeconds);
                if ($blocks < 1) continue;

                $payoutUntil = $reference->copy()->addSeconds($blocks * $intervalSeconds);
                if ($payoutUntil->greaterThan($planEnd)) {
                    $payoutUntil = $planEnd;
                }
            } else {
                continue;
            }

            $payoutSeconds = max(0, $payoutUntil->timestamp - $referenceTs);
            if ($payoutSeconds < 1) continue;

            // Interest = principal * ratePerSecond * (blocks * intervalSeconds)
            $principal = $deposit->amount;
            $interest = round($principal * $ratePerSecond * $payoutSeconds, 8);
            if ($interest <= 0) continue;

            // Apply interest
            try {
                $wallet = Wallet::whereBelongsTo($user)
                    ->where('currency_code', $deposit->crypto_currency)
                    ->first();
                $wallet->increment('balance', $interest);

                // Update deposit records
                $deposit->update([
                    'last_interest_date' => $payoutUntil->toDateTimeString(),
                ]);
                $deposit->increment('interest_balance', $interest);

                // Log transaction
                Transaction::create([
                    'user_id'             => $user->id,
                    'username'            => $user->username,
                    'log_type'            => 'deposit-linear',
                    'crypto_currency'     => $deposit->crypto_currency,
                    'transaction_details' => "Interest payout for deposit {$deposit->id} ({$profitFrequency})",
                    'transaction_id'      => $deposit->id,
                    'amount'              => $interest,
                ]);

                Log::channel('interest')->info(
                    "Payout \${$interest} to {$user->username} for deposit {$deposit->id} at {$profitFrequency} frequency."
                );

                if ($now->greaterThanOrEqualTo($planEnd)) {
                    $this->releaseDeposit($deposit->id);
                }
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
