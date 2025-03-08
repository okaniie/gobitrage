<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'token',
        'plan_id',
        'currency_code',
        'amount',
        'pay_referral',
        'notify',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
