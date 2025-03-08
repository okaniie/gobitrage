<?php

namespace App\Models;

use App\Events\ReferralBonusPaid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_user_id',
        'referral_username',
        'referred_user_id',
        'referred_username',
        'referral_paid',
        'referral_bonus',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'referral_user_id', 'id');
    }

    public static function payReferral($user_id, $amount, $percentage, $currency_code)
    {
        $ref = self::where('referred_user_id', $user_id)->get()->first();
        if ($ref) {
            $bonus = round($percentage / 100 * $amount, 2);
            $ref->increment('referral_bonus', $bonus);
            // add to user's balance too
            $referrer = User::find($ref->referral_user_id);
            if ($referrer) {
                $wallet = Wallet::whereBelongsTo($referrer)->where('currency_code', $currency_code)->first();
                if (!$wallet) {
                    $currency = Currency::where('code', $currency_code)->first();

                    Wallet::create([
                        'user_id' => $referrer->id,
                        'username' => $referrer->username,
                        'currency_id' => $currency->id,
                        'currency_code' => $currency->code,
                        'balance' => $bonus
                    ]);
                } else {
                    $wallet->increment('balance', $bonus);
                }

                Transaction::create([
                    'user_id' => $referrer->id,
                    'username' => $referrer->username,
                    'log_type' => 'referral',
                    'transaction_details' => "Referral bonus of $" . $bonus . " paid to user",
                    'transaction_id' => $ref->id,
                    'amount' => $bonus,
                    'crypto_currency' => $currency_code
                ]);
            }
            ReferralBonusPaid::dispatch($ref, $bonus);
        }
    }
}
