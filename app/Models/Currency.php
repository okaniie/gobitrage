<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'display_name',
        'status',
        'deposit_from_balance',
        'deposit_from_processor',
        'deposit_processor',
        'deposit_address',
        'deposit_min',
        'deposit_max',
        'deposit_fees_percentage',
        'deposit_fees_additional',
        'deposit_fees_min',
        'deposit_fees_max',
        'withdrawal_processor',
        'withdrawal_min',
        'withdrawal_max',
        'withdrawal_fees_percentage',
        'withdrawal_fees_additional',
        'withdrawal_fees_min',
        'withdrawal_fees_max',
        'auto_withdrawal',
        'auto_withdrawal_min',
        'auto_withdrawal_max'
    ];
}
