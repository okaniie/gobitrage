<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->currencyCode(),
            'display_name' => $this->faker->currencyCode(),
            'default_processor' => ['bitpay', 'coinpayments', 'btcpay', ''][rand(0, 3)]
        ];
    }
}
