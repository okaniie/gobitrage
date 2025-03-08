<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'transaction_id',
        'amount',
        'charges',
        'crypto_amount',
        'crypto_currency',
        'address',
        'status_link',
        'status',
        'message_from_user',
        'message_from_admin',
        'details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
