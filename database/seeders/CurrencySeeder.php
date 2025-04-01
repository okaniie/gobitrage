<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        $currencies = [
            [
                'code' => 'BTC',
                'display_name' => 'Bitcoin',
                'status' => '1',
                'deposit_from_balance' => '1',
                'deposit_from_processor' => '1',
                'deposit_processor' => 'paykassa',
                'deposit_address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
                'deposit_min' => 0.001,
                'deposit_max' => 10,
                'deposit_fees_percentage' => 0,
                'deposit_fees_additional' => 0,
                'deposit_fees_min' => 0,
                'deposit_fees_max' => 0,
                'withdrawal_processor' => 'paykassa',
                'withdrawal_min' => 0.001,
                'withdrawal_max' => 10,
                'withdrawal_fees_percentage' => 0,
                'withdrawal_fees_additional' => 0,
                'withdrawal_fees_min' => 0,
                'withdrawal_fees_max' => 0,
                'auto_withdrawal' => '0',
                'auto_withdrawal_min' => 0,
                'auto_withdrawal_max' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'USDT',
                'display_name' => 'Tether USD',
                'status' => '1',
                'deposit_from_balance' => '1',
                'deposit_from_processor' => '1',
                'deposit_processor' => 'paykassa',
                'deposit_address' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
                'deposit_min' => 10,
                'deposit_max' => 100000,
                'deposit_fees_percentage' => 0,
                'deposit_fees_additional' => 0,
                'deposit_fees_min' => 0,
                'deposit_fees_max' => 0,
                'withdrawal_processor' => 'paykassa',
                'withdrawal_min' => 10,
                'withdrawal_max' => 100000,
                'withdrawal_fees_percentage' => 0,
                'withdrawal_fees_additional' => 0,
                'withdrawal_fees_min' => 0,
                'withdrawal_fees_max' => 0,
                'auto_withdrawal' => '0',
                'auto_withdrawal_min' => 0,
                'auto_withdrawal_max' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'TRX',
                'display_name' => 'TRON',
                'status' => '1',
                'deposit_from_balance' => '1',
                'deposit_from_processor' => '1',
                'deposit_processor' => 'paykassa',
                'deposit_address' => 'TXhZ41Z48qV9tWxGJkqXZqZqZqZqZqZqZqZ',
                'deposit_min' => 100,
                'deposit_max' => 1000000,
                'deposit_fees_percentage' => 0,
                'deposit_fees_additional' => 0,
                'deposit_fees_min' => 0,
                'deposit_fees_max' => 0,
                'withdrawal_processor' => 'paykassa',
                'withdrawal_min' => 100,
                'withdrawal_max' => 1000000,
                'withdrawal_fees_percentage' => 0,
                'withdrawal_fees_additional' => 0,
                'withdrawal_fees_min' => 0,
                'withdrawal_fees_max' => 0,
                'auto_withdrawal' => '0',
                'auto_withdrawal_min' => 0,
                'auto_withdrawal_max' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency['code']],
                $currency
            );
        }
    }
}
