<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'deposit_from',
        'plan_id',
        'plan_title',
        'transaction_id',
        'percentage',
        'profit_frequency',
        'address',
        'amount',
        'crypto_currency',
        'crypto_amount',
        'status',
        'details',
        'processor_details',
        'approval_date',
        'interest_balance',
        'last_interest_date',
        'final_interest_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
