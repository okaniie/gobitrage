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

        // Process approved deposits in chunks for efficiency
        Deposit::where('status', 'approved')
            ->chunkById(100, function ($deposits) use ($timestampNow, $now) {
                foreach ($deposits as $deposit) {
                    // Find and validate user
                    $user = $deposit->user()->first();
                    if (!$user) {
                        // Orphaned deposit
                        $deposit->delete();
                        Log::channel('interest')->info(
                            "User {$deposit->username} ({$deposit->user_id}) disappeared; Deposit {$deposit->id} deleted."
                        );
                        continue;
                    }
                    if (!$user->status) {
                        // Inactive user
                        Log::channel('interest')->info(
                            "User {$user->username} is inactive; skipping deposit {$deposit->id}."
                        );
                        continue;
                    }

                    // Determine reference timestamp (approval or last interest)
                    $referenceDate = $deposit->last_interest_date
                        ? Carbon::parse($deposit->last_interest_date)->timestamp
                        : Carbon::parse($deposit->approval_date)->timestamp;

                    // Calculate minimum interval based on profit frequency
                    switch ($deposit->profit_frequency) {
                        case 'year':
                            $minimumInterval = 52 * 7 * 24 * 60 * 60;
                            break;
                        case 'month':
                            $minimumInterval = 4 * 7 * 24 * 60 * 60;
                            break;
                        case 'week':
                            $minimumInterval = 7 * 24 * 60 * 60;
                            break;
                        case 'day':
                            $minimumInterval = 24 * 60 * 60;
                            break;
                        case 'hour':
                            $minimumInterval = 60 * 60;
                            break;
                        case 'minute':
                        case 'mintue': // handle possible typo
                            $minimumInterval = 60;
                            break;
                        case 'end':
                            // One-time payout at plan end, minus 1 minute grace
                            $minimumInterval = strtotime($deposit->final_interest_date)
                                - $referenceDate
                                - 60;
                            break;
                        default:
                            Log::channel('interest')->error(
                                "Unknown profit_frequency '{$deposit->profit_frequency}' for deposit {$deposit->id}."
                            );
                            continue 2;
                    }

                    // Skip if not yet due
                    if ($timestampNow - $referenceDate < $minimumInterval) {
                        continue;
                    }

                    // Pay interest
                    try {
                        $interest = round($deposit->percentage / 100 * $deposit->amount, 2);
                        $wallet = Wallet::whereBelongsTo($user)
                            ->where('currency_code', $deposit->crypto_currency)
                            ->first();
                        $wallet->increment('balance', $interest);

                        // Update last interest date and interest balance
                        $deposit->update([
                            'last_interest_date' => $now->toDateTimeString(),
                        ]);
                        $deposit->increment('interest_balance', $interest);

                        // Log transaction
                        Transaction::create([
                            'user_id'             => $user->id,
                            'username'            => $user->username,
                            'log_type'            => 'deposit-earning',
                            'crypto_currency'     => $deposit->crypto_currency,
                            'transaction_details' => "Interest from \${$deposit->amount} at {$deposit->percentage}%",
                            'transaction_id'      => $deposit->id,
                            'amount'              => $interest,
                        ]);

                        Log::channel('interest')->info(
                            "Paid \${$interest} to {$user->username} for deposit {$deposit->id}."
                        );
                    } catch (\Exception $e) {
                        Log::channel('interest')->error(
                            "Error paying interest for deposit {$deposit->id}: {$e->getMessage()}"
                        );
                        continue;
                    }

                    // Release deposit if plan ended
                    if (
                        $deposit->profit_frequency === 'end' ||
                        empty($deposit->final_interest_date) ||
                        strtotime($deposit->final_interest_date) < $timestampNow
                    ) {
                        $this->releaseDeposit($deposit->id);
                    }
                }
            });

        Log::channel('interest')->info("Interest calculation completed at {$now->toDateTimeString()}");
    }
}
