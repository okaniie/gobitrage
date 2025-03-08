<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    private $currencies = [
        ['code' => 'BTC', 'display_name' => 'Bitcoin'],
        ['code' => 'BCH', 'display_name' => 'Bitcoin Cash'],
        ['code' => 'ETH', 'display_name' => 'Ethereum'],
        ['code' => 'LTC', 'display_name' => 'Litecoin'],
        ['code' => 'DOGE', 'display_name' => 'Dogecoin'],
        ['code' => 'USDT', 'display_name' => 'Tether'],
        ['code' => 'BNB', 'display_name' => 'Binance Coin'],
        ['code' => 'XRP', 'display_name' => 'Ripple'],
        ['code' => 'TRON', 'display_name' => 'Tron'],
        ['code' => 'DASH', 'display_name' => 'Dash'],
        ['code' => 'PAYPAL', 'display_name' => 'PayPal'],
        ['code' => 'PM', 'display_name' => 'Perfect Money'],
        ['code' => 'PAYEER', 'display_name' => 'Payeer'],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed currencies if there is no record of it
        if (!\App\Models\Currency::exists()) {
            foreach ($this->currencies as $currency) {
                \App\Models\Currency::create($currency);
            }
        }
    }
}
